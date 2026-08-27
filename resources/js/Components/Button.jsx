import { Link } from '@inertiajs/react';

const VARIANTS = {
    // Sumi-ink block that fills with vermillion on hover.
    solid: 'bg-sumi-900 text-washi border-sumi-900 hover:bg-shu-700 hover:border-shu-700',
    // Vermillion — reserved for the single most important action on a page.
    shu: 'bg-shu-700 text-washi border-shu-700 hover:bg-sumi-900 hover:border-sumi-900',
    // Indigo.
    kon: 'bg-kon-700 text-washi border-kon-700 hover:bg-kon-900 hover:border-kon-900',
    // Hairline outline on paper.
    outline: 'bg-transparent text-sumi-900 border-sumi-900/30 hover:bg-sumi-900 hover:text-washi hover:border-sumi-900',
    // Hairline outline on a dark ground.
    ghost: 'bg-transparent text-washi border-washi/35 hover:bg-washi hover:text-sumi-900 hover:border-washi',
};

/**
 * A squared-off button — no rounded corners anywhere on this site, which is
 * what keeps the layout feeling Japanese rather than generically Western.
 * The arrow slides on hover.
 */
export default function Button({
    href,
    external = false,
    variant = 'solid',
    className = '',
    arrow = true,
    children,
    ...rest
}) {
    const classes = [
        'group inline-flex items-center justify-center gap-3 border px-8 py-4',
        'text-[0.78rem] font-medium uppercase tracking-[0.22em]',
        'transition-colors duration-500 ease-[cubic-bezier(0.22,1,0.36,1)]',
        VARIANTS[variant] ?? VARIANTS.solid,
        className,
    ].join(' ');

    const inner = (
        <>
            <span>{children}</span>
            {arrow && (
                <span
                    aria-hidden="true"
                    className="transition-transform duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:translate-x-1.5"
                >
                    →
                </span>
            )}
        </>
    );

    if (href && external) {
        return (
            <a href={href} target="_blank" rel="noopener noreferrer" className={classes} {...rest}>
                {inner}
            </a>
        );
    }

    if (href) {
        return (
            <Link href={href} className={classes} {...rest}>
                {inner}
            </Link>
        );
    }

    return (
        <button className={classes} {...rest}>
            {inner}
        </button>
    );
}
