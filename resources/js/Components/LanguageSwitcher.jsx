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
                light ? 'border-washi/25' : 'border-washi/20'
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
                                ? 'bg-shu-600 text-washi'
                                : light
                                  ? 'text-washi/60 hover:bg-washi/10 hover:text-washi'
                                  : 'text-washi/55 hover:bg-washi/10 hover:text-washi'
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
            <span className="text-[0.58rem] tracking-[0.3em] text-washi/40 uppercase">{t('locale.label')}</span>
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
                                    ? 'border-shu-600 bg-shu-600 text-washi'
                                    : 'border-washi/20 text-washi/60 hover:border-washi/45 hover:text-washi'
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
