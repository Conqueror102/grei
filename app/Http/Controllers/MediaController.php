<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function __invoke(Request $request, Media $media)
    {
        $parent = $media->mediable()->withTrashed()->first();
        $admin = $request->user()?->is_admin;
        abort_unless($parent && ($admin || $parent->isPublic()), 404);
        abort_unless(Storage::disk('local')->exists($media->path), 404);
        return response()->file(Storage::disk('local')->path($media->path), [
            'Content-Type' => $media->mime_type,
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => $admin ? 'private, no-store' : 'public, max-age=3600',
        ]);
    }
}
