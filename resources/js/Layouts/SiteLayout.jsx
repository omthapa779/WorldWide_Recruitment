import { Head, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import Header from '../Components/Header';
import Footer from '../Components/Footer';
import { useI18n } from '../lib/i18n';

export default function SiteLayout({ title, description, transparentHeader = false, children }) {
    const { props } = usePage();
    const { t, locale } = useI18n();
    const flash = props.flash ?? {};
    const seo = props.seo ?? {};
    const [notice, setNotice] = useState(null);

    // The root Blade template only renders on a full page load, so after a
    // client-side language switch the <html lang> attribute would otherwise
    // stay on the previous locale — which screen readers and translation
    // tools act on. Keep it in step with the active locale.
    useEffect(() => {
        document.documentElement.lang = locale;
    }, [locale]);

    // The Blade root renders one set of SEO tags server-side so crawlers see
    // them without running JavaScript. On client-side navigation we rewrite
    // those same elements rather than letting anything append a second copy.
    useEffect(() => {
        if (!seo.title) return;

        const set = (selector, attribute, value) => {
            const el = document.head.querySelector(selector);
            if (el && value != null) el.setAttribute(attribute, value);
        };

        set('meta[name="description"]', 'content', seo.description);
        set('link[rel="canonical"]', 'href', seo.canonical);
        set('meta[property="og:title"]', 'content', seo.title);
        set('meta[property="og:description"]', 'content', seo.description);
        set('meta[property="og:image"]', 'content', seo.image);
        set('meta[property="og:url"]', 'content', seo.canonical);
        set('meta[property="og:type"]', 'content', seo.type);
        set('meta[property="og:locale"]', 'content', seo.locale);
        set('meta[name="twitter:title"]', 'content', seo.title);
        set('meta[name="twitter:description"]', 'content', seo.description);
        set('meta[name="twitter:image"]', 'content', seo.image);
    }, [seo.title, seo.description, seo.canonical, seo.image, seo.type, seo.locale]);

    useEffect(() => {
        const message = flash.success || flash.error;
        if (!message) return;

        setNotice({ message, kind: flash.success ? 'success' : 'error' });
        const timer = setTimeout(() => setNotice(null), 6000);
        return () => clearTimeout(timer);
    }, [flash.success, flash.error]);

    return (
        <div className="relative flex min-h-screen flex-col bg-washi">
            <Head title={seo.title ?? title} />

            {/* 和紙 — a whisper of paper grain over the whole page */}
            <div
                aria-hidden="true"
                className="washi-grain-layer pointer-events-none fixed inset-0 z-[60] opacity-[0.035] mix-blend-multiply"
            />

            <Header transparent={transparentHeader} />

            <main className="flex-1">{children}</main>

            <Footer />

            {notice && (
                <div
                    role="status"
                    className={`fixed right-5 bottom-5 z-[70] max-w-sm border px-6 py-4 text-sm shadow-lg ${
                        notice.kind === 'success'
                            ? 'border-l-4 border-kon-700 bg-washi text-sumi-900'
                            : 'border-l-4 border-shu-700 bg-washi text-sumi-900'
                    }`}
                >
                    <span className="mb-1 block font-mincho text-xs tracking-[0.28em] opacity-70">
                        {notice.kind === 'success'
                            ? t('contact.form.flashSuccess')
                            : t('contact.form.flashError')}
                    </span>
                    {notice.message}
                </div>
            )}
        </div>
    );
}
