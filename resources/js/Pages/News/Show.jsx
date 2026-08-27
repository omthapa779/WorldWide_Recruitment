import { Link } from '@inertiajs/react';
import SiteLayout from '../../Layouts/SiteLayout';
import SectionHeading from '../../Components/SectionHeading';
import Reveal from '../../Components/Reveal';
import Button from '../../Components/Button';
import NewsRow from '../../Components/NewsRow';
import { useI18n } from '../../lib/i18n';

export default function NewsShow({ article, more }) {
    const { t } = useI18n();

    return (
        <SiteLayout title={article.title} description={article.excerpt}>
            {/* Article header — kept on paper rather than over an image, so the
                headline reads like a printed page. */}
            <section className="relative overflow-hidden bg-kinari pt-16 pb-14 lg:pt-24 lg:pb-20">
                <div aria-hidden="true" className="shima pointer-events-none absolute inset-0 opacity-60" />

                <div className="relative mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                    <nav
                        aria-label="Breadcrumb"
                        className="flex flex-wrap items-center gap-2 text-[0.65rem] tracking-[0.22em] text-nezumi-400"
                    >
                        <Link href="/" className="hover:text-shu-700">
                            {t('nav.home')}
                        </Link>
                        <span aria-hidden="true">/</span>
                        <Link href="/news" className="hover:text-shu-700">
                            {t('nav.news')}
                        </Link>
                        <span aria-hidden="true">/</span>
                        <span className="text-sumi-700">{t('news.article')}</span>
                    </nav>

                    <div className="mt-8 flex items-center gap-4">
                        <time className="numeral text-[0.75rem] tracking-[0.2em] text-shu-700">
                            {article.postedOn ?? ''}
                        </time>
                        <span aria-hidden="true" className="h-px w-12 bg-sumi-900/20" />
                        <span className="border border-kon-700/30 px-3 py-1 text-[0.6rem] tracking-[0.22em] text-kon-700">
                            {t('news.tag')}
                        </span>
                    </div>

                    <h1 className="mt-6 max-w-4xl text-[clamp(1.9rem,4.6vw,3.4rem)] leading-[1.25] tracking-[0.03em] text-sumi-900">
                        {article.title}
                    </h1>

                    {article.postedOnLong && (
                        <p className="mt-5 text-[0.72rem] tracking-[0.2em] text-nezumi-400">
                            {t('news.published')} {article.postedOnLong}
                        </p>
                    )}
                </div>
            </section>

            {/* Lead image */}
            {article.image && (
                <div className="mx-auto -mt-2 max-w-[1500px] px-6 lg:px-8 xl:px-14">
                    <Reveal className="aspect-[16/8] w-full overflow-hidden border border-sumi-900/12">
                        <img src={article.image} alt={article.title} className="h-full w-full object-cover" />
                    </Reveal>
                </div>
            )}

            {/* Body */}
            <section className="bg-washi py-20 lg:py-28">
                <div className="mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                    <div className="grid gap-14 lg:grid-cols-[0.2fr_1fr_0.25fr]">
                        <span
                            aria-hidden="true"
                            className="tategaki hidden font-mincho text-sm tracking-[0.5em] text-nezumi-300 lg:block"
                        >
                            {t('news.tag')}
                        </span>

                        <article
                            className="prose-wa max-w-none"
                            dangerouslySetInnerHTML={{ __html: article.content ?? '' }}
                        />

                        <aside className="hidden lg:block">
                            <div className="sticky top-28 flex flex-col gap-4 border-t-2 border-shu-700 pt-5">
                                <span className="font-mincho text-sm tracking-[0.14em] text-sumi-900">
                                    {t('common.share')}
                                </span>
                                <Link
                                    href="/news"
                                    className="ink-link mt-2 text-[0.7rem] tracking-[0.18em] text-kon-700"
                                >
                                    ← {t('common.allNews')}
                                </Link>
                            </div>
                        </aside>
                    </div>

                    {/* Extra images from the editor */}
                    {article.images?.length > 1 && (
                        <div className="grid gap-6 pt-16 sm:grid-cols-2">
                            {article.images.slice(1).map((src) => (
                                <Reveal key={src} className="aspect-[4/3] overflow-hidden border border-sumi-900/12">
                                    <img src={src} alt="" loading="lazy" className="h-full w-full object-cover" />
                                </Reveal>
                            ))}
                        </div>
                    )}

                    <div className="mt-16 flex flex-wrap gap-3 border-t border-sumi-900/12 pt-10">
                        <Button href="/news" variant="outline">
                            {t('common.backToNews')}
                        </Button>
                        <Button href="/contact" variant="shu">
                            {t('common.contactUs')}
                        </Button>
                    </div>
                </div>
            </section>

            {/* More */}
            {more.length > 0 && (
                <section className="bg-kinari py-20">
                    <div className="mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                        <SectionHeading no="02" title={t('news.more.title')} accent={t('news.more.accent')} />
                        <div className="flex flex-col pt-8">
                            {more.map((item) => (
                                <NewsRow key={item.id} item={item} />
                            ))}
                        </div>
                    </div>
                </section>
            )}
        </SiteLayout>
    );
}
