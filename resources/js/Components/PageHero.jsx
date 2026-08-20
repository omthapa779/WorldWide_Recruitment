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
        <section className="relative isolate overflow-hidden bg-kon-950 text-washi">
            {image && (
                <>
                    <img src={image} alt="" className="absolute inset-0 h-full w-full object-cover opacity-25" />
                    <div className="absolute inset-0 bg-gradient-to-r from-kon-950 via-kon-950/85 to-kon-950/40" />
                </>
            )}
            <div aria-hidden="true" className="seigaiha absolute inset-0 opacity-20" />

            <div className="relative mx-auto flex max-w-[1500px] flex-col gap-6 px-6 pt-20 pb-16 lg:px-8 lg:pt-28 lg:pb-20 xl:px-14">
                {breadcrumb.length > 0 && (
                    <nav
                        aria-label="Breadcrumb"
                        className="flex flex-wrap items-center gap-2 text-[0.65rem] tracking-[0.22em] text-washi/45"
                    >
                        <Link href="/" className="hover:text-shu-400">
                            {t('nav.home')}
                        </Link>
                        {breadcrumb.map((crumb) => (
                            <span key={crumb.label} className="flex items-center gap-2">
                                <span aria-hidden="true">/</span>
                                {crumb.href ? (
                                    <Link href={crumb.href} className="hover:text-shu-400">
                                        {crumb.label}
                                    </Link>
                                ) : (
                                    <span className="text-washi/75">{crumb.label}</span>
                                )}
                            </span>
                        ))}
                    </nav>
                )}

                <div className="flex items-center gap-4">
                    <span aria-hidden="true" className="h-px w-12 bg-shu-500" />
                    <span className="text-[0.68rem] tracking-[0.38em] text-shu-400">{accent}</span>
                </div>

                <h1 className="max-w-4xl text-[clamp(2.4rem,6vw,4.4rem)] leading-[1.15] tracking-[0.05em]">{title}</h1>

                {lead && <p className="max-w-2xl text-sm leading-loose text-washi/65 sm:text-base">{lead}</p>}
            </div>

            <div
                aria-hidden="true"
                className="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-shu-500/50 to-transparent"
            />
        </section>
    );
}
