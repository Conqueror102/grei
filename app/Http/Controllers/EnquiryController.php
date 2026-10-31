<?php

namespace App\Http\Controllers;

use App\Actions\StoreEnquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function __invoke(Request $request, StoreEnquiry $store)
    {
        $enquiry = $store->handle($request->all());
        return response()->json(['reference' => $enquiry->reference, 'message' => 'Your enquiry is with GREI. We’ll respond using the contact details you shared.'], 201);
    }
}
