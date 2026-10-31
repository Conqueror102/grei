<?php

namespace App\Services;

class VideoEmbed
{
    public static function url(?string $url): ?string
    {
        if (! $url || ! filter_var($url, FILTER_VALIDATE_URL)) return null;
        $parts = parse_url($url);
        if (($parts['scheme'] ?? '') !== 'https') return null;
        $host = strtolower($parts['host'] ?? '');
        $path = $parts['path'] ?? '';
        if (in_array($host, ['youtube.com', 'www.youtube.com', 'youtu.be'], true)) {
            parse_str($parts['query'] ?? '', $query);
            $id = $host === 'youtu.be' ? trim($path, '/') : ($query['v'] ?? (str_starts_with($path, '/embed/') ? substr($path, 7) : ''));
            return is_string($id) && preg_match('/^[A-Za-z0-9_-]{11}$/', $id) ? 'https://www.youtube-nocookie.com/embed/'.$id : null;
        }
        if (in_array($host, ['vimeo.com', 'www.vimeo.com', 'player.vimeo.com'], true) && preg_match('~/(?:video/)?(\d{5,12})$~', $path, $match)) {
            return 'https://player.vimeo.com/video/'.$match[1];
        }
        return null;
    }
}
