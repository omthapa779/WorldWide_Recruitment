import { Link, usePage } from '@inertiajs/react';
import SiteLayout from '../../Layouts/SiteLayout';
import SectionHeading from '../../Components/SectionHeading';
import Reveal from '../../Components/Reveal';
import Button from '../../Components/Button';
import JobCard from '../../Components/JobCard';
import ContactSection from '../../Components/ContactSection';
import { useI18n } from '../../lib/i18n';

export default function JobShow({ job, related }) {
    const { props } = usePage();
    const { t } = useI18n();
    const company = props.company;

    return (
        <SiteLayout title={job.title} description={job.excerpt}>
            {/* Hero */}
            <section className="relative isolate overflow-hidden bg-kon-950 text-washi">
                {job.image && (
                    <img src={job.image} alt="" className="absolute inset-0 h-full w-full object-cover opacity-30" />
                )}
                <div className="absolute inset-0 bg-gradient-to-r from-kon-950 via-kon-950/85 to-kon-950/35" />
                <div aria-hidden="true" className="seigaiha absolute inset-0 opacity-20" />

                <div className="relative mx-auto flex max-w-[1500px] flex-col gap-6 px-6 pt-16 pb-14 lg:px-8 lg:pt-24 lg:pb-20 xl:px-14">
                    <nav
                        aria-label="Breadcrumb"
                        className="flex flex-wrap items-center gap-2 text-[0.65rem] tracking-[0.22em] text-washi/45"
                    >
                        <Link href="/" className="hover:text-shu-400">
                            {t('nav.home')}
                        </Link>
                        <span aria-hidden="true">/</span>
                        <Link href="/jobs" className="hover:text-shu-400">
                            {t('nav.jobs')}
                        </Link>
                        <span aria-hidden="true">/</span>
                        <span className="text-washi/75">{job.title}</span>
                    </nav>

                    <div className="flex flex-wrap items-center gap-3">
                        {job.country && (
                            <span className="bg-shu-600 px-4 py-2 text-[0.62rem] font-medium tracking-[0.24em]">
                                {job.country}
                            </span>
                        )}
                        <span className="border border-washi/25 px-4 py-2 text-[0.62rem] tracking-[0.2em]">
                            {job.positions ?? '—'} {t('jobs.show.positionsAvailable')}
                        </span>
                        {job.postedOn && (
                            <span className="numeral text-[0.68rem] tracking-[0.2em] text-washi/50">
                                {t('jobs.show.postedOn')} {job.postedOn}
                            </span>
                        )}
                    </div>

                    <h1 className="max-w-4xl text-[clamp(2.1rem,5vw,3.8rem)] leading-[1.18] tracking-[0.04em]">
                        {job.title}
                    </h1>
                </div>

                <div
                    aria-hidden="true"
                    className="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-shu-500/50 to-transparent"
                />
            </section>

            {/* Detail */}
            <section className="bg-washi py-20 lg:py-28">
                <div className="mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                    <div className="grid gap-14 lg:grid-cols-[1.35fr_0.65fr] lg:gap-20">
                        <div className="flex flex-col gap-8">
                            <SectionHeading
                                no="01"
                                title={t('jobs.show.details')}
                                accent={t('jobs.show.detailsAccent')}
                            />

                            {job.description ? (
                                <Reveal
                                    delay={80}
                                    className="prose-wa max-w-none border-t border-sumi-900/12 pt-8"
                                    dangerouslySetInnerHTML={{ __html: job.description }}
                                />
                            ) : (
                                <p className="border-t border-sumi-900/12 pt-8 text-sm leading-loose text-nezumi-500">
                                    {t('jobs.show.noDetails')}
                                </p>
                            )}
                        </div>

                        {/* Sticky summary rail */}
                        <Reveal delay={140} className="lg:sticky lg:top-28 lg:self-start">
                            <div className="flex flex-col gap-6 border border-sumi-900/12 bg-kinari p-8">
                                <div className="flex flex-col gap-1">
                                    <span className="font-mincho text-xl tracking-[0.12em] text-sumi-900">
                                        {t('jobs.show.summary')}
                                    </span>
                                    <span className="text-[0.58rem] tracking-[0.28em] text-shu-600">
                                        {t('jobs.show.summaryAccent')}
                                    </span>
                                </div>

                                <dl className="flex flex-col gap-0 border-t border-sumi-900/12">
                                    <SummaryRow label={t('jobs.show.role')} value={job.title} />
                                    <SummaryRow label={t('jobs.show.destination')} value={job.country ?? '—'} />
                                    <SummaryRow label={t('jobs.show.positions')} value={job.positions ?? '—'} />
                                    <SummaryRow label={t('jobs.show.posted')} value={job.postedOn ?? '—'} />
                                    <SummaryRow label={t('jobs.show.licence')} value={company.license} />
                                </dl>

                                <div className="flex flex-col gap-3 border-t border-sumi-900/12 pt-6">
                                    <Button href="/contact" variant="shu" className="w-full">
                                        {t('common.apply')}
                                    </Button>
                                    <a
                                        href={company.socials.whatsapp}
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        className="flex items-center justify-center gap-3 border border-sumi-900/25 px-8 py-4 text-[0.72rem] tracking-[0.22em] text-sumi-900 uppercase transition-colors duration-500 hover:bg-sumi-900 hover:text-washi"
                                    >
                                        WhatsApp
                                    </a>
                                    <a
                                        href={`tel:${company.phone.replace(/\s/g, '')}`}
                                        className="text-center text-[0.7rem] tracking-[0.18em] text-nezumi-500 hover:text-shu-600"
                                    >
                                        {company.phone}
                                    </a>
                                </div>
                            </div>
                        </Reveal>
                    </div>
                </div>
            </section>

            {/* Related */}
            {related.length > 0 && (
                <section className="bg-kinari py-20 lg:py-24">
                    <div className="mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                        <div className="flex flex-col gap-6 border-b border-sumi-900/12 pb-10 sm:flex-row sm:items-end sm:justify-between">
                            <SectionHeading
                                no="02"
                                title={t('jobs.show.other')}
                                accent={t('jobs.show.otherAccent')}
                            />
                            <Button href="/jobs" variant="outline">
                                {t('common.allOpenings')}
                            </Button>
                        </div>

                        <div className="grid gap-8 pt-12 sm:grid-cols-2 lg:grid-cols-3">
                            {related.map((item, i) => (
                                <Reveal key={item.id} delay={i * 90}>
                                    <JobCard job={item} />
                                </Reveal>
                            ))}
                        </div>
                    </div>
                </section>
            )}

            <ContactSection no="03" withMap={false} />
        </SiteLayout>
    );
}

function SummaryRow({ label, value }) {
    return (
        <div className="flex items-baseline justify-between gap-4 border-b border-sumi-900/10 py-3.5">
            <dt className="font-mincho text-sm tracking-[0.12em] text-sumi-900">{label}</dt>
            <dd className="text-right text-sm text-nezumi-500">{value}</dd>
        </div>
    );
}
