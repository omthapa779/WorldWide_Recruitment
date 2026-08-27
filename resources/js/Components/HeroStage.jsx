import { useEffect, useRef, useState } from 'react';
import Button from './Button';
import { useI18n, lines } from '../lib/i18n';
import { usePrefersReducedMotion } from '../lib/motion';

/**
 * 序 — the hero.
 *
 * Deliberately restrained. An earlier version layered per-glyph kinetic type,
 * pointer parallax, a curtain wipe, a drifting pattern and a bouncing seal on
 * top of one another; together they read as a showreel rather than as a
 * licensed recruitment firm. What sells this company is credibility, so the
 * structure now leads with the licence, states the offer plainly, and closes
 * with the figures — one photograph, one gentle entrance, nothing competing.
 *
 * Visibility is still carried by CSS transitions keyed off [data-ready], never
 * by keyframes: if transitions never run, everything lands on its end state and
 * the hero stays readable.
 */
export default function HeroStage({ hero, company, slides = [] }) {
    const { t } = useI18n();
    const reduced = usePrefersReducedMotion();

    const sectionRef = useRef(null);
    const reelRef = useRef(null);

    const [ready, setReady] = useState(false);
    const [active, setActive] = useState(0);

    const reel = slides.length > 0 ? slides : [hero.image];
    const headline = lines(t('home.headline'));
    const stats = t('stats', []) || [];

    useEffect(() => {
        const id = requestAnimationFrame(() => setReady(true));
        return () => cancelAnimationFrame(id);
    }, []);

    useEffect(() => {
        if (reduced || reel.length < 2) return;
        const timer = setInterval(() => {
            if (!document.hidden) setActive((i) => (i + 1) % reel.length);
        }, 7000);
        return () => clearInterval(timer);
    }, [reduced, reel.length]);

    /* One slow vertical drift on the photograph as the page scrolls. The
       pointer tilt is gone — that was the restless part. */
    useEffect(() => {
        if (reduced) return;
        const section = sectionRef.current;
        if (!section) return;

        let frame;
        let target = 0;
        let current = 0;

        const onScroll = () => {
            const rect = section.getBoundingClientRect();
            target = Math.min(Math.max(-rect.top / Math.max(rect.height, 1), 0), 1);
        };
        const tick = () => {
            current += (target - current) * 0.1;
            if (reelRef.current) {
                reelRef.current.style.transform =
                    'translate3d(0, ' + current * 40 + 'px, 0) scale(' + (1.04 + current * 0.03) + ')';
            }
            frame = requestAnimationFrame(tick);
        };

        onScroll();
        frame = requestAnimationFrame(tick);
        window.addEventListener('scroll', onScroll, { passive: true });
        return () => {
            cancelAnimationFrame(frame);
            window.removeEventListener('scroll', onScroll);
        };
    }, [reduced]);

    return (
        <section
            ref={sectionRef}
            data-ready={ready}
            className="hero-stage relative isolate flex min-h-[100svh] flex-col overflow-hidden bg-kon-700 pt-[7.5rem] text-washi lg:pt-[10rem] [@media(min-height:600px)]:h-[100svh]"
        >
            {/* Photograph — the right side on desktop, behind the copy on mobile. */}
            <div ref={reelRef} className="absolute inset-y-0 right-0 w-full will-change-transform lg:w-[46%]">
                {reel.map((src, i) => (
                    <img
                        key={src}
                        src={src}
                        alt=""
                        aria-hidden="true"
                        className={`absolute inset-0 h-full w-full object-cover transition-opacity duration-[1800ms] ease-[cubic-bezier(0.22,1,0.36,1)] ${
                            i === active ? 'opacity-100' : 'opacity-0'
                        }`}
                    />
                ))}
            </div>

            {/* Legibility: a full wash on small screens, a soft seam on desktop. */}
            <div
                aria-hidden="true"
                className="absolute inset-0 bg-gradient-to-b from-kon-700/92 via-kon-700/88 to-kon-700/95 lg:hidden"
            />
            <div
                aria-hidden="true"
                className="absolute inset-y-0 left-0 hidden w-[62%] bg-gradient-to-r from-kon-700 via-kon-700 to-transparent lg:block"
            />

            <div className="relative z-10 mx-auto flex w-full max-w-[1500px] flex-auto flex-col justify-center px-6 py-[clamp(0.5rem,3vh,3rem)] lg:px-8 xl:px-14">
                <div className="max-w-[34rem] lg:max-w-[46%]">
                    {/* Credibility first — the licence is this company's strongest claim. */}
                    <div
                        className="hero-rise flex items-center gap-3 text-[0.7rem] tracking-[0.32em] text-shu-400"
                        style={{ '--d': '60ms' }}
                    >
                        <span aria-hidden="true" className="h-px w-8 bg-shu-400" />
                        {t('home.eyebrow')}
                    </div>

                    <h1
                        className="hero-rise mt-[clamp(0.9rem,2.6vh,1.75rem)] text-[clamp(2.1rem,min(5.4vw,7.4vh),4.4rem)] leading-[1.12] tracking-[0.02em]"
                        style={{ '--d': '150ms' }}
                    >
                        {headline.map((line, i) => (
                            <span key={i} className="block">
                                {line}
                            </span>
                        ))}
                    </h1>

                    <p
                        className="hero-rise mt-[clamp(0.75rem,2vh,1.25rem)] max-w-xl text-[clamp(0.95rem,1.35vw,1.1rem)] leading-relaxed text-washi/85"
                        style={{ '--d': '240ms' }}
                    >
                        {hero.title}
                    </p>

                    <p
                        className="hero-rise mt-3 max-w-xl text-sm leading-relaxed text-washi/70 [@media(max-height:740px)]:hidden"
                        style={{ '--d': '300ms' }}
                    >
                        {t('home.sub')}
                    </p>

                    <div
                        className="hero-rise mt-[clamp(1.1rem,3vh,2rem)] flex flex-wrap items-center gap-3"
                        style={{ '--d': '380ms' }}
                    >
                        <Button href="/contact" variant="shu">
                            {hero.cta}
                        </Button>
                        <Button href="/jobs" variant="ghost">
                            {t('common.viewJobs')}
                        </Button>
                        <a
                            href={company.profilePdf}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="ink-link ml-1 text-[0.72rem] tracking-[0.18em] text-kon-100/80 hover:text-washi"
                        >
                            {t('common.companyProfile')} ↓
                        </a>
                    </div>
                </div>
            </div>

            {/* Figures close the hero. The strongest professional signal available,
                and every one of these is published by the client. */}
            <div
                className="hero-rise relative z-10 border-t border-washi/20 bg-kon-950/70 backdrop-blur-md"
                style={{ '--d': '470ms' }}
            >
                <div className="mx-auto grid max-w-[1500px] grid-cols-2 divide-x divide-washi/15 px-6 sm:grid-cols-4 lg:px-8 xl:px-14">
                    {stats.map((stat) => (
                        <div
                            key={stat.title}
                            className="flex flex-col gap-0.5 py-[clamp(0.8rem,2.4vh,1.5rem)] pr-5 pl-5 first:pl-0"
                        >
                            <span className="numeral text-[clamp(1.35rem,2.4vw,2rem)] leading-none text-washi">
                                {stat.value}
                                {stat.suffix}
                            </span>
                            <span className="text-[0.68rem] tracking-[0.14em] text-washi/80">{stat.title}</span>
                        </div>
                    ))}
                </div>
            </div>

            {/* Reel position, tucked against the photograph. */}
            {reel.length > 1 && (
                <div className="pointer-events-none absolute right-6 bottom-[9rem] z-10 hidden gap-1.5 lg:flex">
                    {reel.map((src, i) => (
                        <span
                            key={src}
                            className={`block h-0.5 transition-all duration-700 ${
                                i === active ? 'w-7 bg-washi' : 'w-3 bg-washi/50'
                            }`}
                        />
                    ))}
                </div>
            )}
        </section>
    );
}
