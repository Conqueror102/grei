<?php

namespace App\Actions;

use App\Models\Enquiry;
use App\Models\Listing;
use App\Models\Project;
use App\Services\StayAvailability;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreEnquiry
{
    public function handle(array $input): Enquiry
    {
        $data = Validator::make($input, [
            'submission_token' => ['required', 'uuid'],
            'service' => ['required', Rule::in(['property', 'stay', 'design', 'general'])],
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email:rfc', 'max:254'],
            'phone' => ['nullable', 'string', 'max:35', 'regex:/^[+0-9()\s.\-]+$/'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'consent' => ['accepted'], 'website' => ['nullable', 'max:0'],
            'listing_id' => ['nullable', 'integer', 'exists:listings,id'],
            'project_id' => ['nullable', 'integer', 'exists:projects,id'],
            'checkin' => ['nullable', 'required_with:checkout', 'date_format:Y-m-d', 'after_or_equal:today'],
            'checkout' => ['nullable', 'required_with:checkin', 'date_format:Y-m-d', 'after:checkin'],
            'guests' => ['nullable', 'integer', 'min:1', 'max:50'],
        ])->validate();

        $listing = empty($data['listing_id']) ? null : Listing::find($data['listing_id']);
        $project = empty($data['project_id']) ? null : Project::find($data['project_id']);
        if (($listing && ! $listing->isPublic()) || ($project && ! $project->isPublic())) {
            throw ValidationException::withMessages(['message' => 'This space is no longer published. Please send a general enquiry.']);
        }
        if ($listing && ($data['service'] !== ($listing->kind === 'stay' ? 'stay' : 'property'))) {
            throw ValidationException::withMessages(['service' => 'Choose the matching service for this space.']);
        }
        if ($project && $data['service'] !== 'design') {
            throw ValidationException::withMessages(['service' => 'Choose design for this project.']);
        }
        if ($listing?->kind === 'stay' && ! empty($data['checkin'])) {
            $result = app(StayAvailability::class)->check($listing, $data['checkin'], $data['checkout'], (int) ($data['guests'] ?? 1));
            if (! $result['available']) throw ValidationException::withMessages(['checkin' => 'Those dates are unavailable. Please choose other dates or ask GREI for alternatives.']);
        }

        $payload = collect($data)->except(['consent', 'website', 'submission_token'])->map(fn ($value) => is_string($value) ? trim($value) : $value)->all();
        $payload['email'] = strtolower($payload['email']);
        $hash = hash('sha256', json_encode($payload));
        $existing = Enquiry::withTrashed()->where('submission_token', $data['submission_token'])->first();
        if ($existing) return $this->sameSubmission($existing, $hash);

        try {
            return Enquiry::create($payload + [
                'reference' => (string) Str::uuid(), 'submission_token' => $data['submission_token'],
                'payload_hash' => $hash, 'consented_at' => now(), 'status' => 'new',
            ]);
        } catch (UniqueConstraintViolationException $exception) {
            $existing = Enquiry::withTrashed()->where('submission_token', $data['submission_token'])->first();
            if (! $existing) throw $exception;
            return $this->sameSubmission($existing, $hash);
        }
    }

    private function sameSubmission(Enquiry $enquiry, string $hash): Enquiry
    {
        if (! hash_equals($enquiry->payload_hash, $hash)) throw ValidationException::withMessages(['submission_token' => 'This enquiry was already sent. Refresh the form to start another.']);
        return $enquiry;
    }
}
