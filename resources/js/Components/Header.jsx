import { Link, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import { useI18n } from '../lib/i18n';
import LanguageSwitcher, { LanguageSwitcherWide } from './LanguageSwitcher';

export const NAV = [
    { href: '/', key: 'home' },
    { href: '/about-us', key: 'about' },
    { href: '/services', key: 'services' },
    { href: '/jobs', key: 'jobs' },
    { href: '/news', key: 'news' },
    { href: '/contact', key: 'contact' },
];

const isCurrent = (url, href) => (href === '/' ? url === '/' : url.startsWith(href));

export default function Header({ transparent = false }) {
    const { url, props } = usePage();
    const { t, isJapanese } = useI18n();
    const company = props.company;
    const [scrolled, setScrolled] = useState(false);
    const [open, setOpen] = useState(false);

    useEffect(() => {
        const onScroll = () => setScrolled(window.scrollY > 40);
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
        return () => window.removeEventListener('scroll', onScroll);
    }, []);

    // Lock the page behind the fullscreen mobile menu.
    useEffect(() => {
        document.body.style.overflow = open ? 'hidden' : '';
        return () => {
            document.body.style.overflow = '';
        };
    }, [open]);

    // Close the menu whenever Inertia swaps the page.
    useEffect(() => setOpen(false), [url]);

    const floating = transparent && !scrolled;

    // Deliberately no entry animation here: the bar's visibility must never
    // depend on an animation running to completion.
    const shellClass = 'sticky top-0 z-50 shadow-sm';

    return (
        <>
            <div className={shellClass}>
                {/* 上部バー — the thin utility bar Japanese corporate sites always carry */}
                <div className="hidden border-b border-sumi-900/10 bg-kinari text-sumi-600 lg:block">
                    <div className="mx-auto flex max-w-[1500px] items-center justify-between px-8 py-2.5 text-[0.68rem] tracking-[0.2em] xl:px-14">
                        <div className="flex items-center gap-3">
                            <span className="font-semibold text-shu-700">{t('common.licenceLabel')}</span>
                            <span className="numeral font-bold">{company.license}</span>
                            <span aria-hidden="true" className="h-3 w-px bg-sumi-900/15" />
                            <span>{t('common.authority')}</span>
                        </div>
                        {/* A div, not a p — this row contains the switcher,
                            and a <div> inside a <p> is invalid HTML that React
                            reports as a hydration error. */}
                        <div className="flex items-center gap-5">
                            <a href={`mailto:${company.email}`} className="ink-link font-medium hover:text-sumi-900">
                                {company.email}
                            </a>
                            <span aria-hidden="true" className="h-3 w-px bg-sumi-900/15" />
                            <a
                                href={`tel:${company.phone.replace(/\s/g, '')}`}
                                className="ink-link font-medium hover:text-sumi-900"
                            >
                                {company.phone}
                            </a>
                            <LanguageSwitcher tone="dark" className="ml-1" />
                        </div>
                    </div>
                </div>

                <header className="border-b border-sumi-900/10 bg-washi/98 backdrop-blur-md transition-shadow duration-300">
                    <div className="mx-auto flex max-w-[1500px] items-center justify-between gap-6 px-6 py-3.5 lg:px-8 xl:px-14">
                        <Link href="/" className="group flex items-center gap-4 py-1">
                            <img
                                src="/resources/images/logo.png"
                                alt="WorldWide Recruitment Services"
                                className="h-14 sm:h-16 lg:h-20 w-auto object-contain transition-transform duration-300 group-hover:scale-105 drop-shadow-sm"
                            />
                            <span className="flex flex-col leading-tight border-l border-sumi-900/15 pl-4">
                                <span className="font-mincho text-[1.1rem] sm:text-[1.25rem] lg:text-[1.35rem] font-bold tracking-[0.06em] text-kon-700">
                                    {company.nameLocalised}
                                </span>
                                <span className="text-[0.64rem] sm:text-[0.7rem] tracking-[0.24em] text-nezumi-500 font-medium">
                                    {isJapanese ? company.name : 'Services Pvt. Ltd.'}
                                </span>
                            </span>
                        </Link>

                        <nav className="hidden items-center gap-7 xl:flex">
                            {NAV.map((item) => {
                                const active = isCurrent(url, item.href);
                                return (
                                    <Link
                                        key={item.href}
                                        href={item.href}
                                        data-active={active}
                                        className={`ink-link flex flex-col items-center gap-0.5 font-medium ${
                                            active
                                                ? 'text-shu-700 font-semibold'
                                                : 'text-sumi-900 hover:text-shu-700'
                                        }`}
                                    >
                                        <span className="font-mincho text-[0.95rem] tracking-[0.12em]">
                                            {t(`nav.${item.key}`)}
                                        </span>
                                    </Link>
                                );
                            })}
                        </nav>

                        <div className="flex items-center gap-3">
                            <Link
                                href="/contact"
                                className="hidden border border-shu-700 bg-shu-700 px-6 py-3 text-[0.68rem] font-medium tracking-[0.22em] text-washi transition-colors duration-500 hover:border-sumi-900 hover:bg-sumi-900 lg:inline-block"
                            >
                                {t('common.headerCta')}
                            </Link>

                            <button
                                type="button"
                                onClick={() => setOpen((v) => !v)}
                                aria-label={t('locale.label')}
                                aria-expanded={open}
                                className="relative z-50 flex h-11 w-11 flex-col items-center justify-center gap-[5px] border border-sumi-900/20 transition-colors duration-300 xl:hidden"
                            >
                                {[0, 1, 2].map((i) => (
                                    <span
                                        key={i}
                                        className={`block h-px w-5 bg-sumi-900 transition-all duration-400 ${
                                            open && i === 0
                                                ? 'translate-y-[6px] rotate-45'
                                                : open && i === 1
                                                  ? 'opacity-0'
                                                  : open && i === 2
                                                    ? '-translate-y-[6px] -rotate-45'
                                                    : ''
                                        }`}
                                    />
                                ))}
                            </button>
                        </div>
                    </div>
                </header>
            </div>

            {/* 全画面メニュー — fullscreen mobile menu */}
            <div
                className={`fixed inset-0 z-40 flex bg-kinari transition-transform duration-700 ease-[cubic-bezier(0.22,1,0.36,1)] xl:hidden ${
                    open ? 'translate-y-0' : '-translate-y-full'
                }`}
            >
                <div aria-hidden="true" className="seigaiha pointer-events-none absolute inset-0 opacity-[0.10]" />

                <div className="relative flex w-full flex-col justify-center gap-1 overflow-y-auto px-8 pt-24 pb-12 sm:px-14">
                    <span
                        aria-hidden="true"
                        className="tategaki absolute top-24 right-6 font-mincho text-xs tracking-[0.5em] text-nezumi-400"
                    >
                        {t('footer.closing')}
                    </span>

                    {NAV.map((item, i) => (
                        <Link
                            key={item.href}
                            href={item.href}
                            className="group flex items-baseline gap-4 border-b border-sumi-900/10 py-4"
                            style={{
                                transitionDelay: `${i * 45}ms`,
                                transform: open ? 'none' : 'translateY(18px)',
                                opacity: open ? 1 : 0,
                                transition: 'transform 0.7s cubic-bezier(0.22,1,0.36,1), opacity 0.7s',
                            }}
                        >
                            <span className="numeral text-[0.6rem] tracking-[0.25em] text-shu-700">
                                {String(i + 1).padStart(2, '0')}
                            </span>
                            <span className="font-mincho text-2xl tracking-[0.1em] text-sumi-900 transition-colors group-hover:text-shu-700 sm:text-3xl">
                                {t(`nav.${item.key}`)}
                            </span>
                        </Link>
                    ))}

                    <LanguageSwitcherWide className="mt-8" />

                    <div className="mt-8 flex flex-col gap-2 text-[0.7rem] tracking-[0.18em] text-nezumi-500">
                        <a href={`mailto:${company.email}`}>{company.email}</a>
                        <a href={`tel:${company.phone.replace(/\s/g, '')}`}>{company.phone}</a>
                        <span className="numeral mt-2 text-shu-700">
                            {t('common.licenceLabel')} {company.license}
                        </span>
                    </div>
                </div>
            </div>
        </>
    );
}
