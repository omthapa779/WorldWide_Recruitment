import { useEffect, useState } from 'react';

/**
 * Tracks the visitor's reduced-motion preference, live.
 *
 * Everything decorative in the hero checks this: with it on, the stage still
 * renders in full, it simply stops moving.
 */
export function usePrefersReducedMotion() {
    const [reduced, setReduced] = useState(false);

    useEffect(() => {
        if (typeof window.matchMedia !== 'function') return;

        const query = window.matchMedia('(prefers-reduced-motion: reduce)');
        const update = () => setReduced(query.matches);

        update();
        query.addEventListener?.('change', update);
        return () => query.removeEventListener?.('change', update);
    }, []);

    return reduced;
}

/**
 * Splits a headline for staggered reveal.
 *
 * Japanese has no word spacing and its glyphs carry weight individually, so
 * it reveals character by character. Latin text reveals word by word —
 * per-character Latin reads as jitter rather than intent.
 */
export function splitHeadline(line, japanese) {
    if (japanese) {
        return Array.from(line).map((char) => ({ text: char, spacer: char === ' ' }));
    }

    return line.split(' ').map((word) => ({ text: word, spacer: false }));
}
