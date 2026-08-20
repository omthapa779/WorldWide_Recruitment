import { useEffect, useRef, useState } from 'react';

/**
 * Counts up once, when the figure first scrolls into view.
 *
 * Like Reveal, this is fail-safe: the figure starts at 0, so if the observer
 * never reports we would be publishing "0 Successful Placements" — worse than
 * no animation at all. If no callback arrives we run the count anyway.
 */
const FALLBACK_MS = 1500;

export default function Counter({ value, suffix = '', duration = 1800, className = '' }) {
    const ref = useRef(null);
    const [display, setDisplay] = useState(0);
    const started = useRef(false);

    useEffect(() => {
        const node = ref.current;
        if (!node) return;

        const run = () => {
            if (started.current) return;
            started.current = true;

            const prefersReduced = window.matchMedia?.('(prefers-reduced-motion: reduce)').matches;
            if (prefersReduced) {
                setDisplay(value);
                return;
            }

            const start = performance.now();
            const tick = (now) => {
                const t = Math.min((now - start) / duration, 1);
                // easeOutExpo — fast off the mark, then settles.
                const eased = t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
                setDisplay(Math.round(eased * value));
                if (t < 1) requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);
        };

        if (typeof IntersectionObserver === 'undefined') {
            run();
            return;
        }

        let heard = false;

        const observer = new IntersectionObserver(
            ([entry]) => {
                heard = true;
                if (entry.isIntersecting) {
                    run();
                    observer.disconnect();
                }
            },
            { threshold: 0.4 },
        );
        observer.observe(node);

        const fallback = setTimeout(() => {
            if (!heard) {
                // No observer callback at all — show the real figure rather
                // than leaving a zero on screen.
                started.current = true;
                setDisplay(value);
            }
        }, FALLBACK_MS);

        return () => {
            clearTimeout(fallback);
            observer.disconnect();
        };
    }, [value, duration]);

    return (
        <span ref={ref} className={`numeral tabular-nums ${className}`}>
            {display}
            {suffix}
        </span>
    );
}
