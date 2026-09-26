import { Link } from '@inertiajs/react';
import { useI18n } from '../lib/i18n';

/**
 * The banner every inner page opens with. Kept deliberately short so the
 * content below it starts high on the screen — Japanese corporate sites
 * rarely give an interior page a full-height hero.
 */
export default function PageHero({ title, accent, lead, image, breadcrumb = [] }) {
    const { t } = useI18n();

    return (
        <section className="relative isolate overflow-hidden bg-kinari text-sumi-900">
            {image && (
                <>
                    <img src={image} alt="" className="absolute inset-0 h-full w-full object-cover opacity-100" />
                    <div className="absolute inset-0 bg-gradient-to-r from-kinari via-kinari/94 to-kinari/50" />
                </>
            )}
            <div aria-hidden="true" className="seigaiha absolute inset-0 opacity-[0.10]" />

            <div className="relative mx-auto flex max-w-[1500px] flex-col gap-6 px-4 pt-20 pb-16 sm:px-6 lg:px-8 lg:pt-28 lg:pb-20">
                {breadcrumb.length > 0 && (
                    <nav
                        aria-label="Breadcrumb"
                        className="flex flex-wrap items-center gap-2 text-[0.65rem] tracking-[0.22em] text-nezumi-400"
                    >
                        <Link href="/" className="hover:text-shu-700">
                            {t('nav.home')}
                        </Link>
                        {breadcrumb.map((crumb) => (
                            <span key={crumb.label} className="flex items-center gap-2">
                                <span aria-hidden="true">/</span>
                                {crumb.href ? (
                                    <Link href={crumb.href} className="hover:text-shu-700">
                                        {crumb.label}
                                    </Link>
                                ) : (
                                    <span className="text-sumi-700">{crumb.label}</span>
                                )}
                            </span>
                        ))}
                    </nav>
                )}

                <div className="flex items-center gap-4">
                    <span aria-hidden="true" className="h-px w-12 bg-shu-500" />
                    <span className="text-[0.68rem] tracking-[0.38em] text-shu-700">{accent}</span>
                </div>

                <h1 className="max-w-4xl text-[clamp(2.4rem,6vw,4.4rem)] leading-[1.15] tracking-[0.05em]">{title}</h1>

                {lead && <p className="max-w-2xl text-sm leading-loose text-nezumi-500 sm:text-base">{lead}</p>}
            </div>

            <div
                aria-hidden="true"
                className="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-shu-500/50 to-transparent"
            />
        </section>
    );
}
