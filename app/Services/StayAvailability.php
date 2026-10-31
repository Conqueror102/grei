<?php

namespace App\Services;

use App\Models\Listing;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StayAvailability
{
    public function check(Listing $listing, string $checkin, string $checkout, int $guests): array
    {
        abort_unless($listing->isPublic() && $listing->kind === 'stay', 404);
        Validator::make(compact('checkin', 'checkout', 'guests'), [
            'checkin' => ['required', 'date_format:Y-m-d', 'after_or_equal:today'],
            'checkout' => ['required', 'date_format:Y-m-d', 'after:checkin'],
            'guests' => ['required', 'integer', 'min:1', 'max:'.($listing->guest_capacity ?: 1)],
        ])->validate();
        $nights = (int) CarbonImmutable::parse($checkin)->diffInDays(CarbonImmutable::parse($checkout));
        if ($nights < $listing->min_nights || $nights > $listing->max_nights) {
            throw ValidationException::withMessages(['checkout' => "Choose a stay between {$listing->min_nights} and {$listing->max_nights} nights."]);
        }
        // Dates are half-open: a departure and a new arrival may share a day.
        $available = ! $listing->blocks()->whereDate('starts_on', '<', $checkout)->whereDate('ends_on', '>', $checkin)->exists();
        return [
            'available' => $available, 'nights' => $nights, 'guests' => $guests,
            'total_minor' => $listing->price_minor === null ? null : $listing->price_minor * $nights,
            'currency' => $listing->currency, 'demo' => $listing->is_demo,
        ];
    }
}
