<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

/**
 * Decides which language the visitor sees.
 *
 * Order of precedence:
 *   1. An explicit choice made with the EN / 日本語 switcher (session).
 *   2. The country reported by a CDN/edge header, when the site sits behind
 *      one — JP gets Japanese, any other known country gets English.
 *   3. The browser's Accept-Language header.
 *   4. The application default.
 *
 * An explicit choice always wins and is never overridden by detection, so a
 * visitor in Japan who switches to English stays on English.
 */
class SetLocale
{
    /** Languages the public site is published in. */
    public const SUPPORTED = ['en', 'ja'];

    /**
     * Country headers set by common edge networks, in order of preference.
     * None of these are present on a plain origin server, in which case
     * detection falls through to the browser language.
     */
    private const COUNTRY_HEADERS = [
        'CF-IPCountry',              // Cloudflare
        'X-Vercel-IP-Country',       // Vercel
        'CloudFront-Viewer-Country', // AWS CloudFront
        'X-Country-Code',            // generic / custom proxies
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $chosen = $request->session()->get('locale');

        $locale = in_array($chosen, self::SUPPORTED, true)
            ? $chosen
            : $this->detect($request);

        App::setLocale($locale);

        $response = $next($request);

        // The same URL can render in either language, so any shared cache
        // must key on the request headers detection depends on.
        if (! in_array($chosen, self::SUPPORTED, true)) {
            $existing = $response->headers->get('Vary');
            $response->headers->set('Vary', $existing ? $existing.', Accept-Language' : 'Accept-Language');
        }

        return $response;
    }

    /**
     * Work out the best language for a visitor who has not chosen one.
     */
    protected function detect(Request $request): string
    {
        if ($country = $this->country($request)) {
            return $country === 'JP' ? 'ja' : 'en';
        }

        if ($this->prefersJapanese($request)) {
            return 'ja';
        }

        $default = config('app.locale', 'en');

        return in_array($default, self::SUPPORTED, true) ? $default : 'en';
    }

    /**
     * The visitor's country as reported by an edge network, or null when no
     * such header is present or it carries a placeholder value.
     */
    protected function country(Request $request): ?string
    {
        foreach (self::COUNTRY_HEADERS as $header) {
            $value = strtoupper(trim((string) $request->header($header)));

            // Cloudflare sends XX when it cannot resolve a country, and T1
            // for Tor traffic; neither tells us anything.
            if ($value !== '' && $value !== 'XX' && $value !== 'T1' && strlen($value) === 2) {
                return $value;
            }
        }

        return null;
    }

    /**
     * True when Accept-Language ranks Japanese above English.
     *
     * Matches the base language, so ja-JP and ja both count.
     */
    protected function prefersJapanese(Request $request): bool
    {
        foreach ($request->getLanguages() as $language) {
            $base = strtolower(substr(str_replace('_', '-', $language), 0, 2));

            if ($base === 'ja') {
                return true;
            }

            if ($base === 'en') {
                return false;
            }
        }

        return false;
    }
}
