import { Link } from '@inertiajs/react';
import { useI18n } from '../lib/i18n';

/**
 * The dated news line used on Japanese corporate sites: date, category tag,
 * headline, all on one hairline-ruled row.
 */
export default function NewsRow({ item }) {
    const { t } = useI18n();

    return (
        <Link
            href={item.url}
            className="group grid gap-2 border-b border-sumi-900/12 py-6 transition-colors duration-400 hover:bg-kinari/70 sm:grid-cols-[auto_auto_1fr_auto] sm:items-center sm:gap-6 sm:px-2"
        >
            <time className="numeral text-[0.75rem] tracking-[0.18em] text-nezumi-500">{item.postedOn ?? '—'}</time>

            <span className="w-fit border border-kon-700/30 px-3 py-1 text-[0.6rem] tracking-[0.22em] text-kon-700">
                {t('news.tag')}
            </span>

            <h3 className="text-base leading-snug tracking-[0.02em] text-sumi-900 transition-colors duration-400 group-hover:text-shu-600 sm:text-lg">
                {item.title}
            </h3>

            <span
                aria-hidden="true"
                className="hidden text-nezumi-400 transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:translate-x-1.5 group-hover:text-shu-600 sm:block"
            >
                →
            </span>
        </Link>
    );
}
