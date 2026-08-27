import { Link, usePage } from '@inertiajs/react';
import { NAV } from './Header';
import { useI18n } from '../lib/i18n';

const SOCIALS = [
    { key: 'facebook', label: 'Facebook', short: 'FB' },
    { key: 'instagram', label: 'Instagram', short: 'IG' },
    { key: 'whatsapp', label: 'WhatsApp', short: 'WA' },
    { key: 'tiktok', label: 'TikTok', short: 'TT' },
];

/**
 * The footer sits on the brand navy lightened (kon-600) — mid-weight between
 * the hero and the paper body, but still blue. A desaturated slate was tried
 * here first and read as grey, which drained the brand out of the page end.
 * White text clears ~7.7:1 on it; the legal strip drops to the hero navy so
 * the page closes on the colour it opened with.
 */
export default function Footer() {
    const { props } = usePage();
    const { t, isJapanese } = useI18n();
    const company = props.company;
    const year = new Date().getFullYear();

    return (
        <footer className="relative overflow-hidden bg-kon-600 text-washi">
            <div aria-hidden="true" className="asanoha-light pointer-events-none absolute inset-0 opacity-60" />
            <div
                aria-hidden="true"
                className="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-shu-500/70 to-transparent"
            />

            <div className="relative mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                {/* Brand + reach */}
                <div className="grid gap-10 py-16 lg:grid-cols-[1.15fr_0.85fr] lg:gap-20">
                    <div className="flex flex-col gap-5">
                        <div className="flex items-center gap-4">
                            <span className="flex shrink-0 items-center justify-center bg-washi p-2 shadow-sm">
                                <img
                                    src="/resources/images/logo.png"
                                    alt=""
                                    className="h-12 w-12 object-contain"
                                />
                            </span>
                            <span className="flex flex-col leading-tight">
                                <span className="font-mincho text-xl tracking-[0.06em] sm:text-2xl">
                                    {company.nameLocalised}
                                </span>
                                <span className="text-[0.68rem] tracking-[0.24em] text-washi/75">
                                    {isJapanese ? company.name : 'Services Pvt. Ltd.'}
                                </span>
                            </span>
                        </div>

                        <p className="max-w-lg text-sm leading-relaxed text-washi/75">{t('footer.blurb')}</p>

                        <div className="flex flex-wrap items-center gap-3 pt-1">
                            <span className="numeral border border-shu-100/40 px-3 py-1.5 text-[0.7rem] tracking-[0.18em] text-shu-100">
                                {t('common.licenceLabel')} {company.license}
                            </span>
                            <span className="text-[0.7rem] tracking-[0.14em] text-washi/75">
                                {t('common.authority')}
                            </span>
                        </div>
                    </div>

                    {/* Offices, side by side */}
                    <div className="grid gap-8 sm:grid-cols-2">
                        <div className="flex flex-col gap-3">
                            <FooterHeading title={t('footer.nepalOffice')} />
                            <address className="flex flex-col gap-1.5 text-sm leading-relaxed text-washi/75 not-italic">
                                <span>{company.address}</span>
                                <a href={`mailto:${company.email}`} className="ink-link w-fit hover:text-shu-100">
                                    {company.email}
                                </a>
                                <a
                                    href={`tel:${company.phone.replace(/\s/g, '')}`}
                                    className="ink-link w-fit hover:text-shu-100"
                                >
                                    {company.phone}
                                </a>
                                <a
                                    href={`tel:${company.phoneAlt.replace(/[\s-]/g, '')}`}
                                    className="ink-link w-fit hover:text-shu-100"
                                >
                                    {company.phoneAlt}
                                </a>
                            </address>
                        </div>

                        <div className="flex flex-col gap-3">
                            <FooterHeading title={t('footer.japanBranch')} />
                            <address className="flex flex-col gap-1.5 text-sm leading-relaxed text-washi/75 not-italic">
                                <span className="font-mincho">{company.japan.postal}</span>
                                <span className="font-mincho">{company.japan.address}</span>
                                <span className="text-xs text-washi/70">{company.japan.addressAlt}</span>
                                <a
                                    href={`tel:${company.japan.phone.replace(/\s/g, '')}`}
                                    className="ink-link w-fit hover:text-shu-100"
                                >
                                    {company.japan.phone}
                                </a>
                            </address>
                        </div>
                    </div>
                </div>

                {/* Links + social */}
                <div className="grid gap-8 border-t border-washi/15 py-10 sm:grid-cols-2 lg:grid-cols-[1fr_1fr_auto]">
                    <div className="flex flex-col gap-3">
                        <FooterHeading title={t('footer.navigation')} />
                        <ul className="grid grid-cols-2 gap-x-6 gap-y-2">
                            {NAV.map((item) => (
                                <li key={item.href}>
                                    <Link
                                        href={item.href}
                                        className="ink-link font-mincho text-sm text-washi/75 hover:text-washi"
                                    >
                                        {t(`nav.${item.key}`)}
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    </div>

                    <div className="flex flex-col gap-3">
                        <FooterHeading title={t('footer.resources')} />
                        <ul className="flex flex-col gap-2 text-sm text-washi/75">
                            <li>
                                <a
                                    href={company.profilePdf}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="ink-link hover:text-washi"
                                >
                                    {t('footer.profilePdf')}
                                </a>
                            </li>
                            <li>
                                <Link href="/jobs" className="ink-link hover:text-washi">
                                    {t('footer.openings')}
                                </Link>
                            </li>
                            <li>
                                <Link href="/news" className="ink-link hover:text-washi">
                                    {t('footer.newsEvents')}
                                </Link>
                            </li>
                            <li>
                                <a href="/admin/dashboard" className="ink-link hover:text-washi">
                                    {t('footer.adminSystem')}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div className="flex flex-col gap-3">
                        <FooterHeading title="SNS" />
                        <div className="flex gap-2">
                            {SOCIALS.map((s) => (
                                <a
                                    key={s.key}
                                    href={company.socials[s.key]}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label={s.label}
                                    className="flex h-10 w-10 items-center justify-center border border-washi/25 text-[0.65rem] tracking-[0.12em] text-washi/80 transition-colors duration-400 hover:border-shu-500 hover:bg-shu-600 hover:text-washi"
                                >
                                    {s.short}
                                </a>
                            ))}
                        </div>
                    </div>
                </div>
            </div>

            {/* Legal strip — a shade deeper so the page closes on a firm edge */}
            <div className="relative border-t border-washi/12 bg-kon-700">
                <div className="mx-auto flex max-w-[1500px] flex-col items-center justify-between gap-2 px-6 py-5 text-[0.7rem] tracking-[0.16em] text-washi/75 sm:flex-row lg:px-8 xl:px-14">
                    <p>
                        © {year} {company.name} {t('footer.rights')}
                    </p>
                    <p className="font-mincho tracking-[0.3em] text-washi/75">{t('footer.route')}</p>
                </div>
            </div>
        </footer>
    );
}

function FooterHeading({ title }) {
    return (
        <div className="flex flex-col gap-1.5">
            <span className="font-mincho text-[0.95rem] tracking-[0.14em] text-washi">{title}</span>
            <span aria-hidden="true" className="h-px w-8 bg-shu-500/70" />
        </div>
    );
}
