import { usePage } from '@inertiajs/react';
import SiteLayout from '../Layouts/SiteLayout';
import PageHero from '../Components/PageHero';
import SectionHeading from '../Components/SectionHeading';
import Reveal from '../Components/Reveal';
import ContactSection from '../Components/ContactSection';
import { useI18n } from '../lib/i18n';

export default function Contact() {
    const { props } = usePage();
    const { t } = useI18n();
    const company = props.company;
    const offices = t('offices', []);

    return (
        <SiteLayout title={t('nav.contact')} description={t('contact.meta')}>
            <PageHero
                title={t('contact.heroTitle')}
                accent={t('contact.heroAccent')}
                lead={t('contact.heroLead')}
                image="/resources/images/hero_japan.jpg"
                breadcrumb={[{ label: t('nav.contact') }]}
            />

            {/* 拠点 — offices */}
            <section className="bg-washi py-24 lg:py-28">
                <div className="mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                    <SectionHeading no="01" title={t('contact.offices.title')} accent={t('contact.offices.accent')} />

                    <div className="grid gap-8 pt-14 lg:grid-cols-3">
                        {offices.map((office, i) => (
                            <Reveal
                                key={office.title}
                                delay={i * 110}
                                className="flex flex-col gap-5 border-t-2 border-kon-700 bg-kinari p-8"
                            >
                                <div className="flex flex-col gap-1">
                                    <h3 className="text-2xl tracking-[0.1em] text-sumi-900">{office.title}</h3>
                                    <span className="text-[0.6rem] tracking-[0.28em] text-shu-700">
                                        {office.accent}
                                    </span>
                                </div>

                                <address className="flex flex-col gap-1 text-sm leading-relaxed text-nezumi-500 not-italic">
                                    {office.lines.map((line) => (
                                        <span key={line} className="font-mincho">
                                            {line}
                                        </span>
                                    ))}
                                </address>

                                <div className="flex flex-col gap-2 border-t border-sumi-900/10 pt-5">
                                    {office.phones.map((phone) => (
                                        <a
                                            key={phone}
                                            href={`tel:${phone.replace(/[\s-]/g, '')}`}
                                            className="ink-link w-fit text-sm text-kon-700 hover:text-shu-700"
                                        >
                                            {phone}
                                        </a>
                                    ))}
                                    <a
                                        href={`mailto:${office.email}`}
                                        className="ink-link w-fit text-sm text-kon-700 hover:text-shu-700"
                                    >
                                        {office.email}
                                    </a>
                                </div>
                            </Reveal>
                        ))}

                        {/* Social / hours card */}
                        <Reveal
                            delay={220}
                            className="flex flex-col gap-5 border-t-2 border-shu-700 bg-kinari p-8 text-sumi-900"
                        >
                            <div className="flex flex-col gap-1">
                                <h3 className="text-2xl tracking-[0.1em]">{t('contact.social.title')}</h3>
                                <span className="text-[0.6rem] tracking-[0.28em] text-shu-700">
                                    {t('contact.social.accent')}
                                </span>
                            </div>

                            <div className="flex flex-wrap gap-2 border-t border-sumi-900/12 pt-5">
                                {[
                                    ['Facebook', company.socials.facebook],
                                    ['Instagram', company.socials.instagram],
                                    ['WhatsApp', company.socials.whatsapp],
                                    ['TikTok', company.socials.tiktok],
                                ].map(([label, href]) => (
                                    <a
                                        key={label}
                                        href={href}
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        className="border border-sumi-900/20 px-4 py-2 text-[0.62rem] tracking-[0.18em] text-sumi-600 transition-colors duration-400 hover:border-shu-700 hover:bg-shu-700 hover:text-washi"
                                    >
                                        {label}
                                    </a>
                                ))}
                            </div>

                            <span className="numeral mt-auto pt-4 text-[0.68rem] tracking-[0.18em] text-shu-700">
                                {t('common.licenceLabel')} {company.license}
                            </span>
                        </Reveal>
                    </div>
                </div>
            </section>

            <ContactSection no="02" />
        </SiteLayout>
    );
}
