import { Link } from '@inertiajs/react';
import SiteLayout from '../../Layouts/SiteLayout';
import PageHero from '../../Components/PageHero';
import SectionHeading from '../../Components/SectionHeading';
import Reveal from '../../Components/Reveal';
import NewsRow from '../../Components/NewsRow';
import Pagination from '../../Components/Pagination';
import EmptyNote from '../../Components/EmptyNote';
import { useI18n } from '../../lib/i18n';

export default function NewsIndex({ news }) {
    const { t } = useI18n();
    const items = news.data;
    const [lead, ...rest] = items;

    return (
        <SiteLayout title={t('nav.news')} description={t('news.meta')}>
            <PageHero
                title={t('news.heroTitle')}
                accent={t('news.heroAccent')}
                lead={t('news.heroLead')}
                image="/resources/images/who_are_we.png"
                breadcrumb={[{ label: t('nav.news') }]}
            />

            <section className="bg-washi py-20 lg:py-28">
                <div className="mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                    <SectionHeading
                        no="01"
                        title={t('news.latestUpdates.title')}
                        accent={t('news.latestUpdates.accent')}
                    />

                    {items.length === 0 ? (
                        <EmptyNote title={t('news.emptyTitle')} body={t('news.emptyBody')} />
                    ) : (
                        <>
                            {/* Lead story */}
                            <Reveal className="pt-12">
                                <Link
                                    href={lead.url}
                                    className="group grid items-center gap-8 border border-sumi-900/12 bg-kinari lg:grid-cols-[1.1fr_1fr]"
                                >
                                    <div className="relative aspect-[16/10] overflow-hidden lg:aspect-auto lg:h-full lg:min-h-[24rem]">
                                        {lead.image ? (
                                            <img
                                                src={lead.image}
                                                alt={lead.title}
                                                className="h-full w-full object-cover transition-transform duration-[1200ms] ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:scale-105"
                                            />
                                        ) : (
                                            <div className="asanoha flex h-full w-full items-center justify-center bg-kinari-dark">
                                                <span className="font-mincho text-4xl tracking-[0.3em] text-kon-700/30">
                                                    {t('news.tag')}
                                                </span>
                                            </div>
                                        )}
                                        <span className="absolute top-0 left-0 bg-shu-600 px-4 py-2 text-[0.6rem] tracking-[0.24em] text-washi">
                                            {t('common.latest')}
                                        </span>
                                    </div>

                                    <div className="flex flex-col gap-4 p-8 lg:p-12">
                                        <div className="flex items-center gap-4">
                                            <time className="numeral text-[0.72rem] tracking-[0.2em] text-shu-600">
                                                {lead.postedOn ?? ''}
                                            </time>
                                            <span aria-hidden="true" className="h-px w-10 bg-sumi-900/20" />
                                            <span className="text-[0.6rem] tracking-[0.26em] text-nezumi-400">
                                                {t('news.tag')}
                                            </span>
                                        </div>

                                        <h2 className="text-[clamp(1.5rem,2.8vw,2.2rem)] leading-snug tracking-[0.04em] text-sumi-900 transition-colors duration-500 group-hover:text-shu-600">
                                            {lead.title}
                                        </h2>

                                        <p className="text-sm leading-loose text-nezumi-500">{lead.excerpt}</p>

                                        <span className="mt-3 flex items-center gap-3 text-[0.68rem] tracking-[0.24em] text-sumi-900">
                                            {t('common.readMore')}
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

                            {/* The rest, as a dated list */}
                            {rest.length > 0 && (
                                <div className="flex flex-col pt-16">
                                    <div className="flex items-center gap-4 border-b border-sumi-900/20 pb-4">
                                        <span className="font-mincho text-lg tracking-[0.14em] text-sumi-900">
                                            {t('common.archive')}
                                        </span>
                                    </div>
                                    {rest.map((item) => (
                                        <NewsRow key={item.id} item={item} />
                                    ))}
                                </div>
                            )}

                            <div className="wa-pagination pt-14">
                                <Pagination links={news.links} />
                            </div>
                        </>
                    )}
                </div>
            </section>
        </SiteLayout>
    );
}
