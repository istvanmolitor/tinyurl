<?php

declare(strict_types=1);

namespace Molitor\Tinyurl\Services;

use Illuminate\Support\Str;
use Molitor\Tinyurl\Models\Tinyurl;

class HtmlService
{
    public function prepareHtml(string $html): string
    {
        return preg_replace_callback(
            '/<a(\s[^>]*)>/i',
            fn(array $matches) => '<a' . preg_replace_callback(
                '#\bhref=(["\'])([^"\']*)\1#',
                fn(array $href) => $this->shouldSkip($href[2])
                    ? $href[0]
                    : 'href="' . route('tinyurl.redirect', $this->findOrCreateTinyurl($href[2])->slug) . '"',
                $matches[1]
            ) . '>',
            $html
        );
    }

    private function shouldSkip(string $href): bool
    {
        return empty($href)
            || str_starts_with($href, '#')
            || str_starts_with($href, 'mailto:')
            || str_starts_with($href, 'tel:');
    }

    private function findOrCreateTinyurl(string $url): Tinyurl
    {
        return Tinyurl::where('url', $url)->firstOr(function () use ($url): Tinyurl {
            do {
                $slug = strtolower(Str::random(6));
            } while (Tinyurl::where('slug', $slug)->exists());

            return Tinyurl::create(['url' => $url, 'slug' => $slug]);
        });
    }
}
