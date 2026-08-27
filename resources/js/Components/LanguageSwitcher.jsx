import { Link } from '@inertiajs/react';
import { useI18n } from '../lib/i18n';

const LABELS = {
    en: { short: 'EN', full: 'English' },
    ja: { short: '日本語', full: '日本語' },
};

/**
 * EN / 日本語 toggle. Each option is a plain link to the locale route, so it
 * works without JavaScript and the browser treats it as ordinary navigation.
 */
export default function LanguageSwitcher({ tone = 'dark', className = '' }) {
    const { locale } = useI18n();
    const light = tone === 'light';

    return (
        <div
            className={`flex items-center border ${
                light ? 'border-washi/25' : 'border-sumi-900/20'
            } ${className}`}
            role="group"
            aria-label="Language"
        >
            {['en', 'ja'].map((code) => {
                const active = locale === code;
                return (
                    <Link
                        key={code}
                        href={`/lang/${code}`}
                        preserveScroll
                        aria-current={active ? 'true' : undefined}
                        className={`px-3 py-1.5 text-[0.62rem] tracking-[0.18em] transition-colors duration-400 ${
                            active
                                ? 'bg-shu-700 text-washi'
                                : light
                                  ? 'text-washi/60 hover:bg-washi/10 hover:text-washi'
                                  : 'text-sumi-600 hover:bg-sumi-900/5 hover:text-sumi-900'
                        }`}
                    >
                        {LABELS[code].short}
                    </Link>
                );
            })}
        </div>
    );
}

/** Larger variant for the fullscreen mobile menu. */
export function LanguageSwitcherWide({ className = '' }) {
    const { locale, t } = useI18n();

    return (
        <div className={`flex flex-col gap-2.5 ${className}`}>
            <span className="text-[0.58rem] tracking-[0.3em] text-nezumi-400 uppercase">{t('locale.label')}</span>
            <div className="flex">
                {['en', 'ja'].map((code) => {
                    const active = locale === code;
                    return (
                        <Link
                            key={code}
                            href={`/lang/${code}`}
                            preserveScroll
                            aria-current={active ? 'true' : undefined}
                            className={`border px-6 py-3 text-[0.7rem] tracking-[0.2em] transition-colors duration-400 ${
                                active
                                    ? 'border-shu-700 bg-shu-700 text-washi'
                                    : 'border-sumi-900/20 text-sumi-600 hover:border-sumi-900/45 hover:text-sumi-900'
                            }`}
                        >
                            {LABELS[code].full}
                        </Link>
                    );
                })}
            </div>
        </div>
    );
}
