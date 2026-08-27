import { Link } from '@inertiajs/react';
import { useI18n } from '../lib/i18n';

/**
 * A job opening as an editorial card: image on top, hairline-ruled meta strip
 * below. The vermillion rule sweeps in from the left on hover.
 */
export default function JobCard({ job, index }) {
    const { t } = useI18n();

    return (
        <Link
            href={job.url}
            className="group relative flex flex-col border border-sumi-900/12 bg-kinari/60 transition-colors duration-500 hover:border-sumi-900/25"
        >
            <div className="relative aspect-[4/3] overflow-hidden bg-nezumi-200">
                {job.image ? (
                    <img
                        src={job.image}
                        alt={job.title}
                        loading="lazy"
                        className="h-full w-full object-cover transition-transform duration-[1100ms] ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:scale-105"
                    />
                ) : (
                    <div className="asanoha flex h-full w-full items-center justify-center bg-kinari-dark">
                        <span className="font-mincho text-3xl tracking-[0.3em] text-kon-700/35">
                            {t('common.recruiting')}
                        </span>
                    </div>
                )}

                <div className="absolute inset-0 bg-gradient-to-t from-sumi-950/25 via-transparent to-transparent" />

                {typeof index === 'number' && (
                    <span className="numeral absolute top-0 left-0 bg-washi/90 px-3 py-2 text-[0.65rem] tracking-[0.2em] text-sumi-900">
                        {String(index + 1).padStart(2, '0')}
                    </span>
                )}

                {job.country && (
                    <span className="absolute right-0 bottom-0 bg-shu-700 px-4 py-2 text-[0.62rem] font-medium tracking-[0.22em] text-washi">
                        {job.country}
                    </span>
                )}
            </div>

            <div className="flex flex-1 flex-col gap-3 p-6">
                <h3 className="text-lg leading-snug tracking-[0.03em] text-sumi-900 transition-colors duration-400 group-hover:text-shu-700">
                    {job.title}
                </h3>

                {job.excerpt && (
                    <p className="line-clamp-3 text-[0.82rem] leading-relaxed text-nezumi-500">{job.excerpt}</p>
                )}

                <div className="mt-auto flex items-center justify-between border-t border-sumi-900/10 pt-4 text-[0.68rem] tracking-[0.18em] text-nezumi-500">
                    <span className="flex items-center gap-2">
                        <span className="font-mincho text-shu-700">{t('common.recruiting')}</span>
                        <span className="numeral text-sumi-900">{job.positions ?? '—'}</span>
                        <span>{t('common.positions')}</span>
                    </span>
                    {job.postedOn && <span className="numeral">{job.postedOn}</span>}
                </div>
            </div>

            <span
                aria-hidden="true"
                className="absolute inset-x-0 bottom-0 h-[2px] origin-right scale-x-0 bg-shu-500 transition-transform duration-600 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:origin-left group-hover:scale-x-100"
            />
        </Link>
    );
}
