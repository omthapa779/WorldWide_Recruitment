<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Builds the per-page SEO payload.
 *
 * This is deliberately computed on the server. The public site is an Inertia
 * SPA with no SSR, so anything added client-side through <Head> is invisible
 * to crawlers that do not execute JavaScript — including most social-preview
 * scrapers. The root Blade template renders these values into the initial
 * HTML, and the React <Head> keeps them in step during client-side
 * navigation.
 */
class Seo
{
    public const SITE_NAME = 'WorldWide Recruitment Services Pvt. Ltd.';

    /**
     * @param  string|null  $title        Page title, without the site name.
     * @param  string|null  $description  Meta description.
     * @param  string|null  $image        Absolute URL to a share image.
     * @param  string       $type         Open Graph object type.
     */
    public static function make(
        ?string $title = null,
        ?string $description = null,
        ?string $image = null,
        string $type = 'website',
        ?string $canonical = null,
    ): array {
        $description = $description
            ? Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($description))), 160)
            : __('site.home.meta');

        return [
            'title' => $title ? $title.' | '.self::SITE_NAME : self::SITE_NAME,
            'description' => $description,
            'canonical' => $canonical ?: url()->current(),
            'image' => $image ?: asset('resources/images/logo.png'),
            'type' => $type,
            'siteName' => self::SITE_NAME,
            'locale' => app()->getLocale() === 'ja' ? 'ja_JP' : 'en_US',
        ];
    }

    /**
     * Organisation markup for the whole site.
     *
     * Every value here is published on wrsnepal.com — see the FACTUAL CLAIMS
     * note in the language files. Do not add properties the client has not
     * confirmed.
     */
    public static function organisation(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'EmploymentAgency',
            'name' => self::SITE_NAME,
            'url' => url('/'),
            'logo' => asset('resources/images/logo.png'),
            'image' => asset('resources/images/logo.png'),
            'description' => __('site.footer.blurb'),
            'email' => 'info@wrsnepal.com',
            'telephone' => '+977-9841893098',
            'address' => [
                [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'Samakhusi Chowk',
                    'addressLocality' => 'Kathmandu',
                    'postalCode' => '44600',
                    'addressCountry' => 'NP',
                ],
                [
                    '@type' => 'PostalAddress',
                    'streetAddress' => '1-24-9 Higashi-Yotsugi, Katsushika-ku',
                    'addressLocality' => 'Tokyo',
                    'postalCode' => '124-0014',
                    'addressCountry' => 'JP',
                ],
            ],
            'areaServed' => ['Japan', 'United Arab Emirates', 'Qatar'],
            'sameAs' => [
                'https://www.facebook.com/share/1BFPtefB9M/?mibextid=wwXIfr',
                'https://www.instagram.com/globalcentralnepal',
                'https://www.tiktok.com/@globalcentralconsultancy',
            ],
        ];
    }
}
