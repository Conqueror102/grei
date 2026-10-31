<?php

return [
    // International digits only, without +, spaces or punctuation. Keep empty
    // until GREI supplies its number; never send enquiries to invented numbers.
    // Database-backed admin settings take precedence over this fallback.
    'whatsapp_number' => env('GREI_WHATSAPP_NUMBER', ''),
    'default_privacy' => "Information you share\nWhen you enquire, GREI collects the name, email, optional phone number, preferences and message you provide. We use these details to respond to your property, stay or design enquiry.\n\nWebsite records\nEnquiries are stored in GREI’s website inbox, accessible to authorised staff. Session cookies support the forms and staff sign-in.\n\nWhatsApp and video\nChoosing a WhatsApp link opens WhatsApp with the details shown. External video providers load only when you choose to play a video tour. Those services handle information under their own policies.\n\nYour information\nContact GREI through the contact page to ask about the information you have shared or request its correction or removal. Share only the details needed for your enquiry.",
    'default_terms' => "Using the website\nThis website introduces GREI’s property, furnished-stay and design services. You can browse and send enquiries without creating an account.\n\nListings and concept studies\nContent marked as a concept or illustrative listing is design-preview content. It does not represent an actual available property, rate or completed commission. For real listings, GREI confirms current details, pricing and availability directly.\n\nReservations and appointments\nChecking dates, submitting a form or starting a WhatsApp conversation does not itself confirm a reservation, purchase or consultation appointment. The final scope, terms and any payment arrangements are agreed directly with GREI.\n\nImages and project material\nPlease contact GREI before reusing website imagery or project content.",
    'show_demo' => env('GREI_SHOW_DEMO', false),
    'retail_enabled' => env('GREI_RETAIL_ENABLED', false),
    'currencies' => ['NGN', 'USD', 'GBP', 'EUR'],
    'property_types' => ['house' => 'House', 'apartment' => 'Apartment', 'townhouse' => 'Townhouse', 'land' => 'Land', 'commercial' => 'Commercial'],
    'categories' => ['sale' => 'For sale', 'rent' => 'For rent', 'investment' => 'Investment'],
    'amenities' => ['Wi-Fi', 'Equipped kitchen', 'Air conditioning', 'Parking', 'Swimming pool', 'Workspace', 'Security', 'Balcony', 'Garden', 'Housekeeping', 'Backup power', 'Laundry'],
    'design_services' => [
        'residential' => ['title' => 'Residential interiors', 'headline' => 'A home. With your signature.', 'image' => 'assets/soft-geometry.webp', 'intro' => 'Spaces that understand how you live. We explore the layout, light and details that make home feel like you.', 'includes' => ['Space planning', 'Materials and colour', 'Furniture and lighting', 'Styling and finishing']],
        'commercial' => ['title' => 'Commercial spaces', 'headline' => 'Character. With a purpose.', 'image' => 'assets/the-social-room.webp', 'intro' => 'An atmosphere people remember. We bring your brand and the way people use your space into the same conversation.', 'includes' => ['Experience and spatial direction', 'Layout and circulation', 'Materials and lighting', 'Furniture and finishing']],
        'styling' => ['title' => 'Styling & finishing', 'headline' => 'The details make the difference.', 'image' => 'assets/city-apartment.webp', 'intro' => 'Sometimes a space needs a new point of view. We consider the pieces, textures and finishing touches that bring a room together.', 'includes' => ['Furniture direction', 'Colour and texture', 'Art and objects', 'Finishing details']],
    ],
];
