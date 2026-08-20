import { useEffect, useRef, useState } from 'react';

/**
 * Scroll-triggered fade + rise. Deliberately slow and small — the point is
 * that content settles onto the page rather than announcing itself.
 *
 * Fail-safe by design. The resting state is `opacity: 0`, so if the observer
 * never reports, the content would be invisible forever. IntersectionObserver
 * normally delivers an initial callback for every observed element almost
 * immediately; if none arrives, we treat the observer as non-functional and
 * show the content regardless. Never let a decorative effect decide whether
 * text is readable.
 */
const FALLBACK_MS = 1500;

export default function Reveal({ as: Tag = 'div', delay = 0, className = '', children, ...rest }) {
    const ref = useRef(null);
    const [shown, setShown] = useState(false);

    useEffect(() => {
        const node = ref.current;
        if (!node) return;

        if (typeof IntersectionObserver === 'undefined') {
            setShown(true);
            return;
        }

        let heard = false;

        const observer = new IntersectionObserver(
            ([entry]) => {
                heard = true;
                if (entry.isIntersecting) {
                    setShown(true);
                    observer.disconnect();
                }
            },
            { rootMargin: '0px 0px -12% 0px', threshold: 0.08 },
        );

        observer.observe(node);

        const fallback = setTimeout(() => {
            if (!heard) setShown(true);
        }, FALLBACK_MS);

        return () => {
            clearTimeout(fallback);
            observer.disconnect();
        };
    }, []);

    return (
        <Tag
            ref={ref}
            data-shown={shown}
            style={{ transitionDelay: `${delay}ms` }}
            className={`reveal ${className}`}
            {...rest}
        >
            {children}
        </Tag>
    );
}
