import SiteLayout from '../Layouts/SiteLayout';
import PageHero from '../Components/PageHero';
import SectionHeading from '../Components/SectionHeading';
import Reveal from '../Components/Reveal';
import Button from '../Components/Button';
import Counter from '../Components/Counter';
import { useI18n } from '../lib/i18n';

export default function Services() {
    const { t } = useI18n();

    const services = t('servicesList', []);
    const stats = t('stats', []);
    const sectors = t('sectors', []);

    return (
        <SiteLayout title={t('nav.services')} description={t('services.meta')}>
            <PageHero
                title={t('services.heroTitle')}
                accent={t('services.heroAccent')}
                lead={t('services.heroLead')}
                image="/resources/images/services/overseas_recruitment.jpg"
                breadcrumb={[{ label: t('nav.services') }]}
            />

            {/* Intro */}
            <section className="bg-washi py-20 lg:py-28">
                <div className="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
                    <div className="grid gap-12 lg:grid-cols-[0.85fr_1.15fr] lg:gap-20">
                        <SectionHeading
                            no="01"
                            title={t('services.overview.title')}
                            accent={t('services.overview.accent')}
                        />
                        <Reveal delay={100} className="flex flex-col gap-6">
                            <p className="font-mincho text-[clamp(1.1rem,2vw,1.45rem)] leading-[1.85] text-sumi-900">
                                {t('services.overview.lead')}
                            </p>
                            <p className="text-sm leading-loose text-nezumi-500 sm:text-[0.95rem]">
                                {t('services.overview.body')}
                            </p>
                        </Reveal>
                    </div>
                </div>
            </section>

            {/* The three services, as full-width alternating rows */}
            <section className="bg-kinari py-20 lg:py-28">
                <div className="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
                    <SectionHeading
                        no="02"
                        title={t('services.pillars.title')}
                        accent={t('services.pillars.accent')}
                    />

                    <div className="flex flex-col gap-20 pt-16 lg:gap-28">
                        {services.map((service, i) => {
                            const flipped = i % 2 === 1;
                            return (
                                <Reveal
                                    key={service.no}
                                    className={`grid items-center gap-10 lg:grid-cols-2 lg:gap-16 ${
                                        flipped ? 'lg:[&>*:first-child]:order-2' : ''
                                    }`}
                                >
                                    <div className="relative">
                                        <div className="aspect-[4/3] w-full overflow-hidden">
                                            <img
                                                src={`/resources/images/services/${service.image}.jpg`}
                                                alt=""
                                                loading="lazy"
                                                className="h-full w-full object-cover"
                                            />
                                        </div>
                                        <span className="numeral absolute -top-5 left-0 bg-shu-700 px-5 py-3 text-[0.72rem] tracking-[0.24em] text-washi">
                                            {service.no}
                                        </span>
                                        <span
                                            aria-hidden="true"
                                            className="tategaki absolute -right-3 bottom-0 hidden font-mincho text-sm tracking-[0.45em] text-nezumi-400 lg:block"
                                        >
                                            {service.title}
                                        </span>
                                    </div>

                                    <div className="flex flex-col gap-5">
                                        <div className="flex flex-col gap-1.5">
                                            <span className="text-[0.6rem] tracking-[0.32em] text-shu-700">
                                                {service.accent}
                                            </span>
                                            <h3 className="text-[clamp(1.9rem,3.4vw,2.7rem)] tracking-[0.08em] text-sumi-900">
                                                {service.title}
                                            </h3>
                                        </div>

                                        <p className="border-t border-sumi-900/12 pt-6 text-sm leading-loose text-nezumi-500 sm:text-[0.95rem]">
                                            {service.body}
                                        </p>
                                    </div>
                                </Reveal>
                            );
                        })}
                    </div>
                </div>
            </section>

            {/* 対応業種 + figures */}
            <section className="relative overflow-hidden bg-washi py-24 lg:py-32">
                <div aria-hidden="true" className="shima pointer-events-none absolute inset-0 opacity-50" />
                <div className="relative mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
                    <div className="grid gap-14 lg:grid-cols-[0.85fr_1.15fr] lg:gap-20">
                        <div className="flex flex-col gap-8">
                            <SectionHeading
                                no="03"
                                title={t('services.sectors.title')}
                                accent={t('services.sectors.accent')}
                            />
                            <Reveal delay={90} className="flex flex-wrap gap-2.5">
                                {sectors.map((sector) => (
                                    <span
                                        key={sector.title}
                                        className="flex items-baseline gap-2 border border-sumi-900/15 bg-washi px-4 py-2.5 transition-colors duration-400 hover:border-shu-500 hover:bg-shu-500/5"
                                    >
                                        <span className="font-mincho text-sm tracking-[0.14em] text-sumi-900">
                                            {sector.title}
                                        </span>
                                        <span className="text-[0.55rem] tracking-[0.2em] text-nezumi-400">
                                            {sector.accent}
                                        </span>
                                    </span>
                                ))}
                            </Reveal>
                        </div>

                        <Reveal
                            delay={140}
                            className="grid gap-px border border-sumi-900/12 bg-sumi-900/12 sm:grid-cols-2"
                        >
                            {stats.map((stat) => (
                                <div key={stat.title} className="flex flex-col gap-2 bg-washi p-8">
                                    <Counter
                                        value={stat.value}
                                        suffix={stat.suffix}
                                        className="text-[clamp(2.2rem,4vw,3rem)] leading-none text-shu-700"
                                    />
                                    <span className="font-mincho text-sm tracking-[0.16em] text-sumi-900">
                                        {stat.title}
                                    </span>
                                    <span className="text-[0.6rem] tracking-[0.24em] text-nezumi-400">
                                        {stat.accent}
                                    </span>
                                </div>
                            ))}
                        </Reveal>
                    </div>
                </div>
            </section>

            {/* CTA */}
            <section className="relative isolate overflow-hidden border-y border-sumi-900/12 bg-kinari py-20 text-sumi-900">
                <div aria-hidden="true" className="asanoha absolute inset-0 opacity-70" />
                <div className="relative mx-auto flex max-w-[1500px] flex-col items-start justify-between gap-8 px-4 sm:px-6 lg:flex-row lg:items-center lg:px-8">
                    <div className="flex flex-col gap-3">
                        <h2 className="text-[clamp(1.8rem,3.6vw,2.6rem)] tracking-[0.08em]">
                            {t('services.cta.title')}
                        </h2>
                        <p className="max-w-xl text-sm leading-loose text-nezumi-500">{t('services.cta.body')}</p>
                    </div>
                    <div className="flex flex-wrap gap-3">
                        <Button href="/contact" variant="shu">
                            {t('common.contactUs')}
                        </Button>
                        <Button href="/jobs" variant="outline">
                            {t('nav.jobs')}
                        </Button>
                    </div>
                </div>
            </section>
        </SiteLayout>
    );
}
