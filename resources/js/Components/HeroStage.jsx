import { useEffect, useMemo, useRef, useState } from 'react';
import Button from './Button';
import HankoSeal from './HankoSeal';
import { useI18n, lines } from '../lib/i18n';
import { usePrefersReducedMotion, splitHeadline } from '../lib/motion';

/**
 * 序 — the hero stage.
 *
 * Four layers move independently: a slow cross-fading image reel behind a
 * drifting seigaiha pattern, the headline, and the seal. Pointer movement and
 * scroll offset both feed one rAF loop that writes transforms straight to the
 * DOM — no React state per frame.
 *
 * Everything that decides *visibility* is a CSS transition driven by the
 * `ready` flag, never a keyframe animation: if animations never run, the
 * transition simply lands on its end state and the hero is fully readable.
 * Keyframes are used only for effects whose failure is invisible (drift, the
 * slow zoom, the scroll-rail highlight).
 */
export default function HeroStage({ hero, company, slides = [] }) {
    const { t, isJapanese } = useI18n();
    const reduced = usePrefersReducedMotion();

    const sectionRef = useRef(null);
    const reelRef = useRef(null);
    const patternRef = useRef(null);
    const contentRef = useRef(null);
    const sealRef = useRef(null);

    const [ready, setReady] = useState(false);
    const [curtain, setCurtain] = useState(true);
    const [active, setActive] = useState(0);

    const reel = slides.length > 0 ? slides : [hero.image];
    const headlineLines = useMemo(() => lines(t('home.headline')), [t]);

    /* -- entrance ---------------------------------------------------------
       The curtain is removed from the DOM outright once it has lifted, so a
       stalled animation can never leave the hero covered. */
    useEffect(() => {
        const start = requestAnimationFrame(() => setReady(true));
        const lift = setTimeout(() => setCurtain(false), reduced ? 100 : 2000);
        return () => {
            cancelAnimationFrame(start);
            clearTimeout(lift);
        };
    }, [reduced]);

    /* -- image reel ------------------------------------------------------- */
    useEffect(() => {
        if (reduced || reel.length < 2) return;

        const advance = () => {
            if (document.hidden) return;
            setActive((i) => (i + 1) % reel.length);
        };

        const timer = setInterval(advance, 6200);
        return () => clearInterval(timer);
    }, [reduced, reel.length]);

    /* -- pointer + scroll parallax ---------------------------------------
       One loop, easing current values toward their targets and writing
       transforms directly. */
    useEffect(() => {
        if (reduced) return;

        const section = sectionRef.current;
        if (!section) return;

        let frame;
        const target = { x: 0, y: 0, scroll: 0 };
        const current = { x: 0, y: 0, scroll: 0 };

        const onPointer = (event) => {
            const rect = section.getBoundingClientRect();
            target.x = (event.clientX - rect.left) / rect.width - 0.5;
            target.y = (event.clientY - rect.top) / rect.height - 0.5;
        };

        const onLeave = () => {
            target.x = 0;
            target.y = 0;
        };

        const onScroll = () => {
            const rect = section.getBoundingClientRect();
            target.scroll = Math.min(Math.max(-rect.top / Math.max(rect.height, 1), 0), 1);
        };

        const tick = () => {
            current.x += (target.x - current.x) * 0.06;
            current.y += (target.y - current.y) * 0.06;
            current.scroll += (target.scroll - current.scroll) * 0.12;

            if (reelRef.current) {
                reelRef.current.style.transform = `translate3d(${current.x * -26}px, ${
                    current.y * -18 + current.scroll * 60
                }px, 0) scale(${1.06 + current.scroll * 0.06})`;
            }
            if (patternRef.current) {
                patternRef.current.style.transform = `translate3d(${current.x * 42}px, ${current.y * 28}px, 0)`;
            }
            if (contentRef.current) {
                contentRef.current.style.transform = `translate3d(${current.x * 12}px, ${
                    current.y * 8 - current.scroll * 90
                }px, 0)`;
                contentRef.current.style.opacity = String(Math.max(1 - current.scroll * 1.35, 0));
            }
            if (sealRef.current) {
                sealRef.current.style.transform = `translate3d(${current.x * -34}px, ${current.y * -22}px, 0)`;
            }

            frame = requestAnimationFrame(tick);
        };

        onScroll();
        frame = requestAnimationFrame(tick);
        window.addEventListener('pointermove', onPointer, { passive: true });
        section.addEventListener('pointerleave', onLeave);
        window.addEventListener('scroll', onScroll, { passive: true });

        return () => {
            cancelAnimationFrame(frame);
            window.removeEventListener('pointermove', onPointer);
            section.removeEventListener('pointerleave', onLeave);
            window.removeEventListener('scroll', onScroll);
        };
    }, [reduced]);

    // Running index for the stagger, so the delay keeps climbing across lines.
    let step = 0;

    return (
        <section
            ref={sectionRef}
            data-ready={ready}
            className="hero-stage relative isolate flex min-h-[100svh] flex-col overflow-hidden bg-kon-950 pt-[clamp(5.25rem,13vh,8.5rem)] text-washi [@media(min-height:600px)]:h-[100svh]"
        >
            {/* 一 — the image reel */}
            <div ref={reelRef} className="absolute inset-0 will-change-transform">
                {reel.map((src, i) => (
                    <img
                        key={src}
                        src={src}
                        alt=""
                        aria-hidden="true"
                        className={`absolute inset-0 h-full w-full object-cover transition-opacity duration-[2200ms] ease-[cubic-bezier(0.22,1,0.36,1)] ${
                            i === active ? 'opacity-45' : 'opacity-0'
                        } ${!reduced && i === active ? 'hero-kenburns' : ''}`}
                    />
                ))}
            </div>

            <div className="absolute inset-0 bg-gradient-to-br from-kon-950 via-kon-950/80 to-kon-900/35" />

            {/* 二 — drifting seigaiha */}
            <div ref={patternRef} className="absolute -inset-16 will-change-transform">
                <div aria-hidden="true" className="seigaiha hero-drift absolute inset-0 opacity-[0.22]" />
            </div>

            {/* 暖簾 — split curtain, removed from the DOM once lifted */}
            {curtain && (
                <div aria-hidden="true" className="pointer-events-none absolute inset-0 z-30 flex">
                    {[0, 1, 2, 3, 4].map((i) => (
                        <span
                            key={i}
                            className="noren-panel h-full flex-1 bg-kinari"
                            style={{ animationDelay: `${120 + i * 100}ms` }}
                        />
                    ))}
                </div>
            )}

            <div className="relative z-10 mx-auto flex w-full max-w-[1500px] flex-auto flex-col justify-center px-6 py-[clamp(0.5rem,3vh,4rem)] lg:px-8 xl:px-14">
                <div className="grid items-center gap-[clamp(1.5rem,5vh,3.5rem)] lg:grid-cols-[1fr_auto]">
                    <div ref={contentRef} className="flex flex-col gap-[clamp(0.8rem,2.4vh,2rem)] will-change-transform">
                        <div className="hero-rise flex items-center gap-4" style={{ '--d': '120ms' }}>
                            <span aria-hidden="true" className="hero-rule h-px w-14 bg-shu-500" />
                            <span className="text-[0.68rem] tracking-[0.4em] text-shu-400">
                                {t('home.eyebrow')}
                            </span>
                        </div>

                        {/* Kinetic headline — each unit rises out of its own mask */}
                        <h1 className="text-[clamp(2rem,min(6.6vw,8vh),5.4rem)] leading-[1.08] tracking-[0.04em]">
                            {headlineLines.map((line, li) => (
                                <span key={li} className="block overflow-hidden py-[0.08em]">
                                    {splitHeadline(line, isJapanese).map((unit, ui) => {
                                        const delay = 260 + step * (isJapanese ? 52 : 90);
                                        step += 1;
                                        return (
                                            <span
                                                key={ui}
                                                className="hero-glyph inline-block whitespace-pre"
                                                style={{ '--d': `${delay}ms` }}
                                            >
                                                {unit.text}
                                                {!isJapanese && ' '}
                                            </span>
                                        );
                                    })}
                                </span>
                            ))}
                        </h1>

                        <p
                            className="hero-rise max-w-xl text-[clamp(0.95rem,min(1.6vw,2.1vh),1.25rem)] leading-relaxed text-washi/80"
                            style={{ '--d': '900ms' }}
                        >
                            {hero.title}
                        </p>

                        <p
                            className="hero-rise max-w-xl text-sm leading-relaxed text-washi/55 [@media(max-height:760px)]:hidden"
                            style={{ '--d': '1020ms' }}
                        >
                            {t('home.sub')}
                        </p>

                        <div
                            className="hero-rise flex flex-wrap items-center gap-3 pt-1"
                            style={{ '--d': '1140ms' }}
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
                                className="ink-link text-[0.72rem] tracking-[0.22em] text-washi/60 hover:text-washi"
                            >
                                {t('common.companyProfile')} ↓
                            </a>
                        </div>
                    </div>

                    <div ref={sealRef} className="hidden flex-col items-center gap-[clamp(1rem,3vh,2rem)] will-change-transform lg:flex">
                        <span
                            aria-hidden="true"
                            className="hero-rise tategaki font-mincho text-lg tracking-[0.6em] text-washi/40 [@media(max-height:860px)]:hidden"
                            style={{ '--d': '1260ms' }}
                        >
                            {t('home.vertical')}
                        </span>
                        {/* The seal presses down like a stamp rather than fading in */}
                        <span className="hero-stamp" style={{ '--d': '1420ms' }}>
                            <HankoSeal license={company.license} size="lg" />
                        </span>
                    </div>
                </div>
            </div>

            {/* Foot of the stage: scroll cue, reel position, licence */}
            <div className="relative z-10 mx-auto flex w-full max-w-[1500px] items-end justify-between gap-6 px-6 pb-[clamp(0.75rem,3vh,2.5rem)] lg:px-8 xl:px-14">
                <div
                    className="hero-rise flex items-center gap-3 text-[0.62rem] tracking-[0.3em] text-washi/45"
                    style={{ '--d': '1500ms' }}
                >
                    <span aria-hidden="true" className="hero-scroll-rail relative block h-10 w-px bg-washi/20" />
                    <span>{t('common.scroll')}</span>
                </div>

                {reel.length > 1 && (
                    <div
                        className="hero-rise hidden items-center gap-3 sm:flex [@media(max-height:600px)]:!hidden"
                        style={{ '--d': '1560ms' }}
                        role="tablist"
                        aria-label="Hero images"
                    >
                        {reel.map((src, i) => (
                            <button
                                key={src}
                                type="button"
                                role="tab"
                                aria-selected={i === active}
                                aria-label={`Image ${i + 1}`}
                                onClick={() => setActive(i)}
                                className="group flex items-center gap-2 py-2"
                            >
                                <span className="numeral text-[0.58rem] tracking-[0.2em] text-washi/35 group-hover:text-washi/70">
                                    {String(i + 1).padStart(2, '0')}
                                </span>
                                <span
                                    className={`block h-px transition-all duration-700 ease-[cubic-bezier(0.22,1,0.36,1)] ${
                                        i === active ? 'w-10 bg-shu-500' : 'w-4 bg-washi/25 group-hover:bg-washi/50'
                                    }`}
                                />
                            </button>
                        ))}
                    </div>
                )}

                <div className="flex items-center gap-6 lg:hidden">
                    <HankoSeal license={company.license} size="sm" />
                </div>

                <p
                    className="hero-rise hidden max-w-xs text-right text-[0.68rem] leading-relaxed tracking-[0.14em] text-washi/40 lg:block"
                    style={{ '--d': '1620ms' }}
                >
                    {t('common.licenceLabel')} {company.license}
                    <br />
                    {t('common.authority')}
                </p>
            </div>
        </section>
    );
}
