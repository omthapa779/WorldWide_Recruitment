import { Head, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import Header from '../Components/Header';
import Footer from '../Components/Footer';
import { useI18n } from '../lib/i18n';

export default function SiteLayout({ title, description, transparentHeader = false, children }) {
    const { props } = usePage();
    const { t, locale } = useI18n();
    const flash = props.flash ?? {};
    const [notice, setNotice] = useState(null);

    // The root Blade template only renders on a full page load, so after a
    // client-side language switch the <html lang> attribute would otherwise
    // stay on the previous locale — which screen readers and translation
    // tools act on. Keep it in step with the active locale.
    useEffect(() => {
        document.documentElement.lang = locale;
    }, [locale]);

    useEffect(() => {
        const message = flash.success || flash.error;
        if (!message) return;

        setNotice({ message, kind: flash.success ? 'success' : 'error' });
        const timer = setTimeout(() => setNotice(null), 6000);
        return () => clearTimeout(timer);
    }, [flash.success, flash.error]);

    return (
        <div className="relative flex min-h-screen flex-col bg-washi">
            <Head>
                <title>{title}</title>
                {description && <meta name="description" content={description} />}
            </Head>

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
                            ? 'border-kon-700 bg-kon-700 text-washi'
                            : 'border-shu-700 bg-shu-700 text-washi'
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
