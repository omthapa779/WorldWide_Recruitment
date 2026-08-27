import { useMemo, useState } from 'react';
import SiteLayout from '../../Layouts/SiteLayout';
import PageHero from '../../Components/PageHero';
import SectionHeading from '../../Components/SectionHeading';
import Reveal from '../../Components/Reveal';
import JobCard from '../../Components/JobCard';
import Pagination from '../../Components/Pagination';
import Button from '../../Components/Button';
import EmptyNote from '../../Components/EmptyNote';
import { useI18n } from '../../lib/i18n';

export default function JobsIndex({ jobs, countries }) {
    const { t } = useI18n();
    const [country, setCountry] = useState('all');

    // Filters the current page client-side — the paginator still governs
    // which records are on screen.
    const visible = useMemo(
        () => (country === 'all' ? jobs.data : jobs.data.filter((job) => job.country === country)),
        [country, jobs.data],
    );

    return (
        <SiteLayout title={t('nav.jobs')} description={t('jobs.meta')}>
            <PageHero
                title={t('jobs.heroTitle')}
                accent={t('jobs.heroAccent')}
                lead={t('jobs.heroLead')}
                image="/resources/images/services/deployment.jpg"
                breadcrumb={[{ label: t('nav.jobs') }]}
            />

            <section className="bg-washi py-20 lg:py-28">
                <div className="mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                    <div className="flex flex-col gap-8 border-b border-sumi-900/12 pb-8 lg:flex-row lg:items-end lg:justify-between">
                        <SectionHeading
                            no="01"
                            title={t('jobs.openRoles.title')}
                            accent={t('jobs.openRoles.accent')}
                        />

                        <div className="flex items-center gap-3 text-[0.7rem] tracking-[0.16em] text-nezumi-500">
                            <span className="numeral text-sumi-900">{jobs.total ?? visible.length}</span>
                            <span>{t('jobs.listed')}</span>
                        </div>
                    </div>

                    {countries.length > 1 && (
                        <div className="flex flex-wrap items-center gap-2 pt-8">
                            <span className="mr-2 text-[0.6rem] tracking-[0.28em] text-nezumi-400">
                                {t('jobs.destination')}
                            </span>
                            <FilterChip active={country === 'all'} onClick={() => setCountry('all')}>
                                {t('jobs.all')}
                            </FilterChip>
                            {countries.map((c) => (
                                <FilterChip key={c} active={country === c} onClick={() => setCountry(c)}>
                                    {c}
                                </FilterChip>
                            ))}
                        </div>
                    )}

                    {visible.length > 0 ? (
                        <>
                            <div className="grid gap-8 pt-12 sm:grid-cols-2 lg:grid-cols-3">
                                {visible.map((job, i) => (
                                    <Reveal key={job.id} delay={(i % 3) * 90}>
                                        <JobCard job={job} index={i} />
                                    </Reveal>
                                ))}
                            </div>

                            <div className="wa-pagination pt-14">
                                <Pagination links={jobs.links} />
                            </div>
                        </>
                    ) : (
                        <EmptyNote title={t('jobs.emptyTitle')} body={t('jobs.emptyBody')} />
                    )}

                    <Reveal className="mt-20 flex flex-col items-start justify-between gap-6 border border-sumi-900/12 bg-kinari p-10 lg:flex-row lg:items-center">
                        <div className="flex flex-col gap-2">
                            <h3 className="text-2xl tracking-[0.08em] text-sumi-900">{t('jobs.ctaTitle')}</h3>
                            <p className="max-w-xl text-sm leading-loose text-nezumi-500">{t('jobs.ctaBody')}</p>
                        </div>
                        <Button href="/contact" variant="shu">
                            {t('common.registerInterest')}
                        </Button>
                    </Reveal>
                </div>
            </section>
        </SiteLayout>
    );
}

function FilterChip({ active, onClick, children }) {
    return (
        <button
            type="button"
            onClick={onClick}
            className={`border px-4 py-2 text-[0.68rem] tracking-[0.18em] transition-colors duration-400 ${
                active
                    ? 'border-shu-700 bg-shu-700 text-washi'
                    : 'border-sumi-900/15 text-sumi-900 hover:border-sumi-900'
            }`}
        >
            {children}
        </button>
    );
}
