<?php

namespace App\Services;

use App\Models\Listing;

class WhatsApp
{
    public function __construct(private BrandSettings $settings) {}

    public function link(string $message): ?string
    {
        $number = $this->settings->whatsappNumber();
        return $number ? 'https://wa.me/'.$number.'?text='.rawurlencode($message) : null;
    }

    public function stayMessage(Listing $listing, string $checkin, string $checkout, int $guests): string
    {
        $intro = $listing->is_demo ? 'I’d like a furnished stay similar to the '.$listing->title.' concept.' : 'I’d like to book '.$listing->title.'.';
        return "Hello GREI,\n\n{$intro}\nCheck-in: {$checkin}\nCheck-out: {$checkout}\nGuests: {$guests}\n\nPlease confirm the apartment, final rate, amenities and availability.\n".route('stays.show', $listing);
    }
}
