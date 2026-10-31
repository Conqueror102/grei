<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class BrandSettings
{
    private ?array $loaded = null;
    public function all(): array
    {
        return $this->loaded ??= Cache::rememberForever('grei.brand-settings', fn () => SiteSetting::pluck('value', 'key')->all());
    }

    public function get(string $key, ?string $default = null): ?string { return $this->all()[$key] ?? $default; }

    public function whatsappNumber(): string
    {
        $value = preg_replace('/[\s+()\-]/', '', $this->get('whatsapp_number', config('grei.whatsapp_number', '')) ?? '');
        return preg_match('/^[1-9]\d{7,14}$/', $value) ? $value : '';
    }

    public function save(array $values): void
    {
        \Illuminate\Support\Facades\DB::transaction(function () use ($values) {
            foreach ($values as $key => $value) SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        });
        Cache::forget('grei.brand-settings');
        $this->loaded = null;
    }
}
