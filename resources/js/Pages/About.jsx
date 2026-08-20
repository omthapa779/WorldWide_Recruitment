import { usePage } from '@inertiajs/react';
import SiteLayout from '../Layouts/SiteLayout';
import PageHero from '../Components/PageHero';
import SectionHeading from '../Components/SectionHeading';
import Reveal from '../Components/Reveal';
import Button from '../Components/Button';
import Counter from '../Components/Counter';
import HankoSeal from '../Components/HankoSeal';
import { useI18n } from '../lib/i18n';

export default function About() {
    const { props } = usePage();
    const { t } = useI18n();
    const company = props.company;

    const services = t('servicesList', []);
    const reasons = t('reasons', []);
    const stats = t('stats', []);
    const corporateProfile = t('corporateProfile', []);

    return (
        <SiteLayout title={t('nav.about')} description={t('about.meta')}>
            <PageHero
                title={t('about.heroTitle')}
                accent={t('about.heroAccent')}
                lead={t('about.heroLead')}
                image="/resources/images/About_page.jpg"
                breadcrumb={[{ label: t('nav.about') }]}
            />

            {/* ごあいさつ */}
            <section className="relative bg-washi py-24 lg:py-32">
                <div className="mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                    <div className="grid gap-14 lg:grid-cols-[0.9fr_1.1fr] lg:gap-20">
                        <div className="flex flex-col gap-8">
                            <SectionHeading no="01" title={t('about.intro.title')} accent={t('about.intro.accent')} />
                            <Reveal delay={80} className="flex items-start gap-6">
                                <HankoSeal license={company.license} size="md" />
                                <p className="max-w-xs text-[0.8rem] leading-loose text-nezumi-500">
                                    {t('common.authorityFull')}
                                </p>
                            </Reveal>
                        </div>

                        <Reveal delay={140} className="flex flex-col gap-6">
                            <p className="font-mincho text-[clamp(1.15rem,2.2vw,1.6rem)] leading-[1.8] text-sumi-900">
                                {t('about.intro.lead')}
                            </p>
                            <p className="text-sm leading-loose text-nezumi-500 sm:text-[0.95rem]">
                                {t('about.intro.body1')}
                            </p>
                            <p className="text-sm leading-loose text-nezumi-500 sm:text-[0.95rem]">
                                {t('about.intro.body2')}
                            </p>

                            <div className="flex flex-wrap gap-3 pt-3">
                                <Button href="/services" variant="outline">
                                    {t('common.ourServices')}
                                </Button>
                                <Button href="/contact" variant="shu">
                                    {t('common.contactUs')}
                                </Button>
                            </div>
                        </Reveal>
                    </div>
                </div>
            </section>

            {/* 実績 — figures */}
            <section className="relative overflow-hidden bg-sumi-950 py-20 text-washi">
                <div aria-hidden="true" className="seigaiha absolute inset-0 opacity-20" />
                <div className="relative mx-auto grid max-w-[1500px] gap-px bg-washi/12 sm:grid-cols-2 lg:grid-cols-4">
                    {stats.map((stat) => (
                        <div key={stat.title} className="flex flex-col gap-2 bg-sumi-950 px-8 py-10">
                            <Counter
                                value={stat.value}
                                suffix={stat.suffix}
                                className="text-[clamp(2.4rem,4.5vw,3.4rem)] leading-none text-shu-400"
                            />
                            <span className="font-mincho text-sm tracking-[0.16em]">{stat.title}</span>
                            <span className="text-[0.6rem] tracking-[0.24em] text-washi/45">{stat.accent}</span>
                        </div>
                    ))}
                </div>
            </section>

            {/* 事業内容 */}
            <section className="bg-kinari py-24 lg:py-32">
                <div className="mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                    <SectionHeading no="02" title={t('about.what.title')} accent={t('about.what.accent')} />

                    <div className="grid gap-8 pt-14 md:grid-cols-3">
                        {services.map((service, i) => (
                            <Reveal
                                key={service.no}
                                delay={i * 100}
                                className="group flex flex-col gap-4 border-t-2 border-sumi-900 bg-washi p-8 transition-colors duration-500 hover:border-shu-500"
                            >
                                <span className="numeral text-[0.7rem] tracking-[0.24em] text-shu-600">
                                    {service.no}
                                </span>

                                <h3 className="text-2xl tracking-[0.08em] text-sumi-900">{service.title}</h3>
                                <span className="text-[0.62rem] tracking-[0.28em] text-nezumi-500">
                                    {service.accent}
                                </span>

                                <p className="border-t border-sumi-900/10 pt-5 text-[0.85rem] leading-loose text-nezumi-500">
                                    {service.body}
                                </p>
                            </Reveal>
                        ))}
                    </div>
                </div>
            </section>

            {/* 会社概要 — the corporate data table */}
            <section className="relative overflow-hidden bg-washi py-24 lg:py-32">
                <div aria-hidden="true" className="shima pointer-events-none absolute inset-0 opacity-60" />
                <div className="relative mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                    <div className="grid gap-14 lg:grid-cols-[0.8fr_1.2fr] lg:gap-20">
                        <SectionHeading no="03" title={t('about.profile.title')} accent={t('about.profile.accent')} />

                        <Reveal delay={140} className="border-t border-sumi-900/15">
                            <dl className="flex flex-col">
                                {corporateProfile.map((row) => (
                                    <div
                                        key={row.title}
                                        className="grid gap-1 border-b border-sumi-900/12 py-5 sm:grid-cols-[220px_1fr] sm:gap-8"
                                    >
                                        <dt className="flex items-baseline gap-3">
                                            <span className="font-mincho text-[0.95rem] tracking-[0.14em] text-sumi-900">
                                                {row.title}
                                            </span>
                                            <span className="text-[0.55rem] tracking-[0.22em] text-nezumi-400">
                                                {row.accent}
                                            </span>
                                        </dt>
                                        <dd className="text-sm leading-relaxed text-nezumi-500">{row.value}</dd>
                                    </div>
                                ))}
                            </dl>
                        </Reveal>
                    </div>
                </div>
            </section>

            {/* 選ばれる理由 */}
            <section className="relative isolate overflow-hidden bg-kon-950 py-24 text-washi lg:py-32">
                <img
                    src="/resources/images/why_choose_us.png"
                    alt=""
                    loading="lazy"
                    className="absolute inset-0 h-full w-full object-cover opacity-10"
                />
                <div className="absolute inset-0 bg-kon-950/85" />
                <div aria-hidden="true" className="seigaiha absolute inset-0 opacity-20" />

                <div className="relative mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                    <SectionHeading
                        no="04"
                        title={t('about.why.title')}
                        accent={t('about.why.accent')}
                        tone="light"
                    />

                    <div className="grid gap-x-8 gap-y-8 pt-14 sm:grid-cols-2 lg:grid-cols-5">
                        {reasons.map((reason, i) => (
                            <Reveal key={reason.no} delay={i * 70} className="flex gap-4 border-t border-washi/12 pt-6">
                                <span className="numeral shrink-0 text-[0.7rem] tracking-[0.2em] text-shu-400">
                                    {reason.no}
                                </span>
                                <div className="flex flex-col gap-2">
                                    <h3 className="text-xl tracking-[0.08em] text-washi">{reason.title}</h3>
                                    <span className="text-[0.6rem] tracking-[0.26em] text-washi/45">
                                        {reason.accent}
                                    </span>
                                </div>
                            </Reveal>
                        ))}
                    </div>

                    <Reveal className="mt-16 flex flex-wrap items-center gap-5 border-t border-washi/12 pt-10">
                        <Button href="/jobs" variant="shu">
                            {t('common.currentOpenings')}
                        </Button>
                        <Button href="/contact" variant="ghost">
                            {t('common.contactUs')}
                        </Button>
                    </Reveal>
                </div>
            </section>
        </SiteLayout>
    );
}
