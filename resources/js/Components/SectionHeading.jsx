import Reveal from './Reveal';

/**
 * The section header used across the site:
 *
 *   01 ──  SERVICES          01 ──  Our Services
 *          事業内容                  事業内容
 *      (Japanese mode)          (English mode)
 *
 * `title` always leads in the language being read; `accent` is the other
 * language, set small above it. Both come straight from the translation file,
 * so the pairing flips automatically with the locale.
 */
export default function SectionHeading({
    no,
    title,
    accent,
    align = 'left',
    tone = 'dark',
    className = '',
}) {
    const light = tone === 'light';

    return (
        <Reveal className={`flex flex-col gap-3 ${align === 'center' ? 'items-center text-center' : ''} ${className}`}>
            <div className="flex items-center gap-4">
                {no && (
                    <span className={`numeral text-xs tracking-[0.3em] ${light ? 'text-shu-400' : 'text-shu-600'}`}>
                        {no}
                    </span>
                )}
                <span aria-hidden="true" className={`h-px w-10 ${light ? 'bg-washi/35' : 'bg-sumi-900/25'}`} />
                <span
                    className={`text-[0.7rem] font-medium tracking-[0.35em] ${
                        light ? 'text-washi/70' : 'text-nezumi-500'
                    }`}
                >
                    {accent}
                </span>
            </div>

            <h2
                className={`text-[clamp(1.9rem,4.2vw,3.1rem)] leading-[1.25] tracking-[0.06em] ${
                    light ? 'text-washi' : 'text-sumi-900'
                }`}
            >
                {title}
            </h2>
        </Reveal>
    );
}
