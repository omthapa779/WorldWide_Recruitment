import { Link } from '@inertiajs/react';
import { useI18n } from '../lib/i18n';

/** Laravel's paginator links, rendered as squared hairline tiles. */
export default function Pagination({ links }) {
    const { isJapanese } = useI18n();

    if (!links || links.length <= 3) return null;

    const prev = isJapanese ? '前へ' : 'Prev';
    const next = isJapanese ? '次へ' : 'Next';

    return (
        <nav className="flex flex-wrap items-center justify-center gap-2 pt-6" aria-label="Pagination">
            {links.map((link, i) => {
                const label = link.label
                    .replace('&laquo; Previous', prev)
                    .replace('Next &raquo;', next)
                    .replace(/&[a-z]+;/g, '');

                const base =
                    'numeral flex h-11 min-w-11 items-center justify-center border px-4 text-[0.72rem] tracking-[0.14em] transition-colors duration-400';

                if (!link.url) {
                    return (
                        <span key={i} className={`${base} cursor-not-allowed border-sumi-900/10 text-nezumi-300`}>
                            {label}
                        </span>
                    );
                }

                return (
                    <Link
                        key={i}
                        href={link.url}
                        preserveScroll={false}
                        className={`${base} ${
                            link.active
                                ? 'border-shu-600 bg-shu-600 text-washi'
                                : 'border-sumi-900/15 text-sumi-900 hover:border-sumi-900 hover:bg-sumi-900 hover:text-washi'
                        }`}
                    >
                        {label}
                    </Link>
                );
            })}
        </nav>
    );
}
