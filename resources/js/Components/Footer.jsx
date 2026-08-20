import { Link, usePage } from '@inertiajs/react';
import { NAV } from './Header';
import { useI18n } from '../lib/i18n';

const SOCIALS = [
    { key: 'facebook', label: 'Facebook', short: 'FB' },
    { key: 'instagram', label: 'Instagram', short: 'IG' },
    { key: 'whatsapp', label: 'WhatsApp', short: 'WA' },
    { key: 'tiktok', label: 'TikTok', short: 'TT' },
];

export default function Footer() {
    const { props } = usePage();
    const { t, isJapanese } = useI18n();
    const company = props.company;
    const year = new Date().getFullYear();

    return (
        <footer className="relative overflow-hidden bg-sumi-950 text-washi">
            <div aria-hidden="true" className="seigaiha pointer-events-none absolute inset-0 opacity-[0.18]" />
            <div
                aria-hidden="true"
                className="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-shu-500/60 to-transparent"
            />

            <div className="relative mx-auto max-w-[1500px] px-6 pt-20 pb-10 lg:px-8 xl:px-14">
                <div className="flex flex-col gap-10 border-b border-washi/12 pb-14 lg:flex-row lg:items-end lg:justify-between">
                    <div className="flex items-start gap-8">
                        <span
                            aria-hidden="true"
                            className="tategaki hidden font-mincho text-lg tracking-[0.45em] text-shu-400/80 sm:block"
                        >
                            {t('footer.closing')}
                        </span>
                        <div className="flex flex-col gap-5">
                            <img
                                src="/resources/images/logo.png"
                                alt=""
                                className="h-14 w-14 object-contain opacity-90 brightness-0 invert"
                            />
                            <h2 className="font-mincho text-2xl leading-snug tracking-[0.06em] sm:text-3xl">
                                {company.nameLocalised}
                                <br />
                                <span className="text-washi/60">
                                    {isJapanese ? company.name : 'Services Pvt. Ltd.'}
                                </span>
                            </h2>
                            <p className="max-w-md text-sm leading-relaxed text-washi/55">{t('footer.blurb')}</p>
                        </div>
                    </div>

                    <div className="flex flex-col items-start gap-4 lg:items-end">
                        <span className="numeral border border-shu-500/40 px-4 py-2 text-[0.7rem] tracking-[0.2em] text-shu-400">
                            {t('common.licenceLabel')} {company.license}
                        </span>
                        <div className="flex gap-2">
                            {SOCIALS.map((s) => (
                                <a
                                    key={s.key}
                                    href={company.socials[s.key]}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label={s.label}
                                    className="flex h-11 w-11 items-center justify-center border border-washi/20 text-[0.65rem] tracking-[0.15em] text-washi/70 transition-colors duration-400 hover:border-shu-500 hover:bg-shu-500 hover:text-washi"
                                >
                                    {s.short}
                                </a>
                            ))}
                        </div>
                    </div>
                </div>

                <div className="grid gap-10 border-b border-washi/12 py-14 sm:grid-cols-2 lg:grid-cols-4">
                    <div className="flex flex-col gap-4">
                        <FooterHeading title={t('footer.navigation')} />
                        <ul className="flex flex-col gap-2.5">
                            {NAV.map((item) => (
                                <li key={item.href}>
                                    <Link
                                        href={item.href}
                                        className="ink-link inline-flex items-baseline gap-2 text-sm text-washi/65 hover:text-washi"
                                    >
                                        <span className="font-mincho">{t(`nav.${item.key}`)}</span>
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    </div>

                    <div className="flex flex-col gap-4">
                        <FooterHeading title={t('footer.nepalOffice')} />
                        <address className="flex flex-col gap-2.5 text-sm leading-relaxed text-washi/65 not-italic">
                            <span>{company.address}</span>
                            <a href={`mailto:${company.email}`} className="ink-link w-fit hover:text-washi">
                                {company.email}
                            </a>
                            <a
                                href={`tel:${company.phone.replace(/\s/g, '')}`}
                                className="ink-link w-fit hover:text-washi"
                            >
                                {company.phone}
                            </a>
                            <a
                                href={`tel:${company.phoneAlt.replace(/[\s-]/g, '')}`}
                                className="ink-link w-fit hover:text-washi"
                            >
                                {company.phoneAlt}
                            </a>
                        </address>
                    </div>

                    <div className="flex flex-col gap-4">
                        <FooterHeading title={t('footer.japanBranch')} />
                        <address className="flex flex-col gap-2.5 text-sm leading-relaxed text-washi/65 not-italic">
                            <span className="font-mincho">{company.japan.postal}</span>
                            <span className="font-mincho">{company.japan.address}</span>
                            <span className="text-xs text-washi/40">{company.japan.addressAlt}</span>
                            <a
                                href={`tel:${company.japan.phone.replace(/\s/g, '')}`}
                                className="ink-link w-fit hover:text-washi"
                            >
                                {company.japan.phone}
                            </a>
                        </address>
                    </div>

                    <div className="flex flex-col gap-4">
                        <FooterHeading title={t('footer.resources')} />
                        <ul className="flex flex-col gap-2.5 text-sm text-washi/65">
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
                </div>

                <div className="flex flex-col items-center justify-between gap-3 pt-8 text-[0.68rem] tracking-[0.18em] text-washi/40 sm:flex-row">
                    <p>
                        © {year} {company.name} {t('footer.rights')}
                    </p>
                    <p className="font-mincho tracking-[0.3em]">{t('footer.route')}</p>
                </div>
            </div>
        </footer>
    );
}

function FooterHeading({ title }) {
    return (
        <div className="flex flex-col gap-1">
            <span className="font-mincho text-base tracking-[0.14em] text-washi">{title}</span>
            <span aria-hidden="true" className="h-px w-8 bg-shu-400/60" />
        </div>
    );
}
