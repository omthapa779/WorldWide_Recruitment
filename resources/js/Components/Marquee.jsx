import { useCallback, useEffect, useLayoutEffect, useRef, useState } from 'react';

/**
 * A slow horizontal band of destination names.
 *
 * The track is two identical groups animated by exactly -50%, which loops
 * seamlessly *only* if one group is already wider than the container. With a
 * short list (three destinations) a single pass does not fill the screen, so
 * the group repeats the items as many times as needed first — otherwise the
 * end of the strip is visible and the wrap is obvious.
 *
 * Speed is constant in pixels per second regardless of how much content
 * there is, so adding destinations does not make the band race.
 */
const PIXELS_PER_SECOND = 55;

export default function Marquee({ items = [], className = '' }) {
    const wrapRef = useRef(null);
    const measureRef = useRef(null);
    const [reps, setReps] = useState(2);
    const [duration, setDuration] = useState(30);

    // `measureRef` always holds exactly one pass of the items, hidden from
    // view and from assistive tech, so it stays a stable unit to measure.
    const recalculate = useCallback(() => {
        const wrap = wrapRef.current;
        const unit = measureRef.current;
        if (!wrap || !unit) return;

        const unitWidth = unit.scrollWidth;
        // Guard against measuring mid-layout, when the wrapper can briefly
        // report a width narrower than the window and under-provision the loop.
        const wrapWidth = Math.max(wrap.clientWidth, window.innerWidth || 0);
        if (unitWidth <= 0 || wrapWidth <= 0) return;

        // One group must exceed the container, plus a pass of headroom.
        const needed = Math.max(2, Math.ceil(wrapWidth / unitWidth) + 1);
        const groupWidth = unitWidth * needed;

        setReps(needed);
        setDuration(Math.max(12, groupWidth / PIXELS_PER_SECOND));
    }, []);

    useLayoutEffect(() => {
        recalculate();
    }, [recalculate, items]);

    useEffect(() => {
        // The window listener is unconditional on purpose: a ResizeObserver
        // that never reports would silently leave the strip too short and the
        // end of the loop visible. Correctness must not depend on it.
        window.addEventListener('resize', recalculate);

        let observer;
        if (typeof ResizeObserver !== 'undefined' && wrapRef.current) {
            observer = new ResizeObserver(recalculate);
            observer.observe(wrapRef.current);
        }

        return () => {
            window.removeEventListener('resize', recalculate);
            observer?.disconnect();
        };
    }, [recalculate]);

    if (items.length === 0) return null;

    const pass = (keyPrefix) =>
        items.map((item, i) => (
            <span key={`${keyPrefix}-${item}-${i}`} className="flex shrink-0 items-center gap-10">
                <span className="text-[0.72rem] tracking-[0.32em] text-sumi-600 uppercase">{item}</span>
                <span aria-hidden="true" className="text-shu-500">
                    ◆
                </span>
            </span>
        ));

    const group = (groupKey) => (
        <div className="flex shrink-0 items-center gap-10 pr-10" aria-hidden={groupKey === 'b' ? 'true' : undefined}>
            {Array.from({ length: reps }, (_, r) => pass(`${groupKey}-${r}`)).flat()}
        </div>
    );

    return (
        <div
            ref={wrapRef}
            className={`relative overflow-hidden border-y border-sumi-900/12 bg-kinari py-4 ${className}`}
        >
            {/* Hidden reference copy: one pass, used purely for measurement. */}
            <div
                ref={measureRef}
                aria-hidden="true"
                className="pointer-events-none absolute top-0 left-0 flex items-center gap-10 opacity-0"
                style={{ visibility: 'hidden' }}
            >
                {pass('measure')}
            </div>

            <div
                className="animate-marquee flex w-max items-center whitespace-nowrap"
                style={{ animationDuration: `${duration}s` }}
            >
                {group('a')}
                {group('b')}
            </div>

            <div
                aria-hidden="true"
                className="pointer-events-none absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-kinari to-transparent"
            />
            <div
                aria-hidden="true"
                className="pointer-events-none absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-kinari to-transparent"
            />
        </div>
    );
}
