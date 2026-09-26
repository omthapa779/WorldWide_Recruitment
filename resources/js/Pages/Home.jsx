import { Link, usePage } from '@inertiajs/react';
import SiteLayout from '../Layouts/SiteLayout';
import SectionHeading from '../Components/SectionHeading';
import Reveal from '../Components/Reveal';
import Button from '../Components/Button';
import HeroStage from '../Components/HeroStage';
import JobCard from '../Components/JobCard';
import NewsRow from '../Components/NewsRow';
import Marquee from '../Components/Marquee';
import ContactSection from '../Components/ContactSection';
import EmptyNote from '../Components/EmptyNote';
import { useI18n } from '../lib/i18n';

export default function Home({ hero, heroSlides, ad, featuredJobs, latestNews }) {
    const { props } = usePage();
    const { t } = useI18n();
    const company = props.company;

    return (
        <SiteLayout title={t('nav.home')} description={t('home.meta')}>
            <HeroStage hero={hero} company={company} slides={heroSlides} />
            <NewsSection news={latestNews} />
            <Marquee items={t('home.destinations', [])} />
            <About />
            <Services />
            <FeaturedJobs jobs={featuredJobs} />
            <AdBanner ad={ad} />
            <ContactSection no="05" />
        </SiteLayout>
    );
}


/* ==================================================== 02 — 私たちについて */

function About() {
    const { t } = useI18n();
    const company = usePage().props.company;

    return (
        <section className="relative bg-washi py-24 lg:py-32">
            <div className="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
                <div className="grid gap-14 lg:grid-cols-[0.95fr_1.05fr] lg:gap-20">
                    <div className="flex flex-col gap-8">
                        <SectionHeading no="02" title={t('home.about.title')} accent={t('home.about.accent')} />

                        <Reveal delay={80} className="flex flex-col gap-6">
                            <p className="font-mincho text-[clamp(1.1rem,2vw,1.45rem)] leading-[1.9] text-sumi-900">
                                {t('home.about.lead')}
                            </p>
                            <p className="text-sm leading-loose text-nezumi-500 sm:text-[0.95rem]">
                                {t('home.about.body1')}
                            </p>
                            <p className="text-sm leading-loose text-nezumi-500 sm:text-[0.95rem]">
                                {t('home.about.body2')}
                            </p>

                            <div className="flex flex-wrap gap-3 pt-2">
                                <Button href="/about-us" variant="outline">
                                    {t('common.learnMore')}
                                </Button>
                                <Button href="/services" variant="outline" arrow={false}>
                                    {t('common.ourServices')}
                                </Button>
                            </div>
                        </Reveal>
                    </div>

                    <Reveal delay={140} className="relative">
                        <div className="relative aspect-[4/3.2] w-full overflow-hidden">
                            <img
                                src="/resources/images/About_page.jpg"
                                alt=""
                                loading="lazy"
                                className="h-full w-full object-cover"
                            />
                        </div>

                        {/* The licence number — the one credential the client
                            actually publishes. Previously a founding year, which
                            wrsnepal.com does not state anywhere. */}
                        <div className="absolute -bottom-8 -left-6 hidden w-60 flex-col gap-1 border-t-2 border-shu-700 bg-kinari p-6 text-kon-700 shadow-sm sm:flex">
                            <span className="numeral text-2xl">{company.license}</span>
                            <span className="font-mincho text-sm tracking-[0.2em]">
                                {t('home.about.licenceCaption')}
                            </span>
                            <span className="text-[0.6rem] tracking-[0.24em] text-nezumi-500">
                                {t('home.about.licenceAccent')}
                            </span>
                        </div>

                        <span
                            aria-hidden="true"
                            className="tategaki absolute -top-4 -right-3 hidden font-mincho text-sm tracking-[0.5em] text-nezumi-400 lg:block"
                        >
                            {t('home.about.verticalAccent')}
                        </span>
                    </Reveal>
                </div>
            </div>
        </section>
    );
}

/* ========================================================= 03 — 事業内容 */

function Services() {
    const { t } = useI18n();
    const services = t('servicesList', []);

    return (
        <section className="relative overflow-hidden bg-kinari py-24 lg:py-32">
            <div aria-hidden="true" className="asanoha pointer-events-none absolute inset-0 opacity-70" />

            <div className="relative mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
                <div className="flex flex-col gap-6 border-b border-sumi-900/12 pb-10 lg:flex-row lg:items-end lg:justify-between">
                    <SectionHeading no="03" title={t('home.services.title')} accent={t('home.services.accent')} />
                    <p className="max-w-md text-sm leading-loose text-nezumi-500">{t('home.services.intro')}</p>
                </div>

                <div className="mt-14 grid gap-px border border-sumi-900/12 bg-sumi-900/12 md:grid-cols-3">
                    {services.map((service, i) => (
                        <Reveal key={service.no} delay={i * 110}>
                            <Link
                                href="/services"
                                className="group relative flex h-full flex-col bg-washi transition-colors duration-500 hover:bg-kinari-dark"
                            >
                                <div className="relative aspect-[16/10] overflow-hidden">
                                    <img
                                        src={`/resources/images/services/${service.image}.jpg`}
                                        alt=""
                                        loading="lazy"
                                        className="h-full w-full object-cover grayscale-[0.35] transition-all duration-[1100ms] ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:scale-105 group-hover:grayscale-0"
                                    />
                                    <div className="absolute inset-0 bg-washi/25 transition-opacity duration-500 group-hover:opacity-0" />
                                    <span className="numeral absolute top-0 left-0 bg-shu-700 px-4 py-2.5 text-[0.68rem] tracking-[0.24em] text-washi">
                                        {service.no}
                                    </span>
                                </div>

                                <div className="flex flex-1 flex-col gap-4 p-8">
                                    <div className="flex flex-col gap-1">
                                        <h3 className="text-2xl tracking-[0.08em] text-sumi-900 transition-colors duration-500 group-hover:text-shu-700">
                                            {service.title}
                                        </h3>
                                        <span className="text-[0.6rem] tracking-[0.28em] text-shu-700">
                                            {service.accent}
                                        </span>
                                    </div>

                                    <p className="text-[0.85rem] leading-loose text-nezumi-500 transition-colors duration-500 group-hover:text-sumi-700">
                                        {service.body}
                                    </p>

                                    <span className="mt-auto flex items-center gap-3 pt-4 text-[0.65rem] tracking-[0.24em] text-sumi-900 transition-colors duration-500 group-hover:text-shu-700">
                                        {t('common.viewDetail')}
                                        <span
                                            aria-hidden="true"
                                            className="transition-transform duration-500 group-hover:translate-x-1.5"
                                        >
                                            →
                                        </span>
                                    </span>
                                </div>
                            </Link>
                        </Reveal>
                    ))}
                </div>
            </div>
        </section>
    );
}

/* ========================================================= 04 — 求人情報 */

function FeaturedJobs({ jobs }) {
    const { t } = useI18n();

    return (
        <section className="bg-washi py-24 lg:py-32">
            <div className="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
                <div className="flex flex-col gap-6 border-b border-sumi-900/12 pb-10 sm:flex-row sm:items-end sm:justify-between">
                    <SectionHeading no="04" title={t('home.jobs.title')} accent={t('home.jobs.accent')} />
                    <Button href="/jobs" variant="outline">
                        {t('common.allOpenings')}
                    </Button>
                </div>

                {jobs.length > 0 ? (
                    <div className="grid gap-8 pt-14 sm:grid-cols-2 lg:grid-cols-3">
                        {jobs.map((job, i) => (
                            <Reveal key={job.id} delay={i * 90}>
                                <JobCard job={job} index={i} />
                            </Reveal>
                        ))}
                    </div>
                ) : (
                    <EmptyNote title={t('home.jobs.emptyTitle')} body={t('home.jobs.emptyBody')} />
                )}
            </div>
        </section>
    );
}

/* ============================================================ 広告バナー */

function AdBanner({ ad }) {
    return (
        <section className="bg-kinari py-16">
            <div className="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
                <Reveal className="relative overflow-hidden border border-sumi-900/12">
                    <img src={ad.image} alt={ad.title} loading="lazy" className="w-full object-cover" />
                </Reveal>
            </div>
        </section>
    );
}

/* ========================================================= 01 — お知らせ */

function NewsSection({ news }) {
    const { t } = useI18n();

    return (
        <section className="bg-washi py-24 lg:py-32">
            <div className="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
                <div className="flex flex-col gap-6 border-b border-sumi-900/12 pb-10 sm:flex-row sm:items-end sm:justify-between">
                    <SectionHeading no="01" title={t('home.news.title')} accent={t('home.news.accent')} />
                    <Button href="/news" variant="outline">
                        {t('common.allNews')}
                    </Button>
                </div>

                {news.length > 0 ? (
                    <div className="flex flex-col pt-6">
                        {news.map((item) => (
                            <NewsRow key={item.id} item={item} />
                        ))}
                    </div>
                ) : (
                    <EmptyNote title={t('home.news.emptyTitle')} body={t('home.news.emptyBody')} />
                )}
            </div>
        </section>
    );
}
