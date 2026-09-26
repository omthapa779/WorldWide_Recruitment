<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Support\Seo;
use Illuminate\Support\Facades\App;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root Blade template that boots the React app.
     */
    protected $rootView = 'app';

    /**
     * Cache-bust the client bundle whenever the assets change.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Props shared with every page.
     *
     * The whole `site` translation file travels with each response so the
     * React layer can read any string without the controller having to pass
     * it. Company details live here too, so headers, footers and contact
     * blocks never hard-code them.
     */
    public function share(Request $request): array
    {
        $locale = App::getLocale();
        $japanese = $locale === 'ja';

        return array_merge(parent::share($request), [
            'locale' => $locale,
            'locales' => SetLocale::SUPPORTED,
            'translations' => trans('site'),

            // Default SEO for any page that does not supply its own.
            'seo' => Seo::make(),
            'organisationSchema' => Seo::organisation(),

            'company' => [
                'name' => 'WorldWide Recruitment Services Pvt. Ltd.',
                'nameLocalised' => $japanese
                    ? 'ワールドワイド・リクルートメント・サービス'
                    : 'WorldWide Recruitment Services',
                'legalSuffix' => $japanese ? '株式会社' : 'Pvt. Ltd.',
                'short' => 'WRS Nepal',
                'license' => '1617-079/80',
                'email' => 'wrsnepal@gmail.com',
                'phone' => '+977 9841893098',
                'phoneAlt' => '+977-01-5363716',
                'address' => $japanese
                    ? 'Samakhusi Chowk, Kathmandu 44600, Nepal'
                    : 'Samakhusi Chowk, Kathmandu 44600, Nepal',
                'japan' => [
                    'postal' => '〒124-0014',
                    // The Japanese address reads natively in ja and
                    // transliterated in en.
                    'address' => $japanese
                        ? '東京都葛飾区東四つ木1-24-9'
                        : '1-24-9 Higashi-Yotsugi, Katsushika-ku, Tokyo',
                    'addressAlt' => $japanese
                        ? '1-24-9 Higashi-Yotsugi, Katsushika-ku, Tokyo'
                        : '東京都葛飾区東四つ木1-24-9',
                    'phone' => '+81 80 3095 6977',
                ],
                'socials' => [
                    'facebook' => 'https://www.facebook.com/share/1BFPtefB9M/?mibextid=wwXIfr',
                    'instagram' => 'https://www.instagram.com/globalcentralnepal?igsh=aDFubmR4MndybHgz&utm_source=qr',
                    'whatsapp' => 'https://wa.me/9779841893098',
                    'tiktok' => 'https://www.tiktok.com/@globalcentralconsultancy?_t=ZS-8x8N2viTRvL&_r=1',
                ],
                'profilePdf' => asset('resources/WorldWide_Company_Profile.pdf'),
            ],

            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
            ],
        ]);
    }
}
