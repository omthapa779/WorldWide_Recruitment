import { useForm, usePage } from '@inertiajs/react';
import SectionHeading from './SectionHeading';
import Reveal from './Reveal';
import { useI18n } from '../lib/i18n';

const MAP_SRC =
    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56502.91421938035!2d85.25245413124996!3d27.734814200000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19001bb93d65%3A0x9f733cc944a06193!2sWorldwide%20Recruitment%20Services%20Pvt.%20Ltd.!5e0!3m2!1sen!2snp!4v1750745616561!5m2!1sen!2snp';

const FIELD =
    'w-full border border-sumi-900/15 bg-washi px-4 py-3.5 text-sm text-sumi-900 outline-none transition-colors duration-300 placeholder:text-nezumi-400 focus:border-shu-500 focus:ring-1 focus:ring-shu-500/30';

export default function ContactSection({ no = '06', withMap = true }) {
    const { props } = usePage();
    const { t } = useI18n();
    const company = props.company;
    const inquiryTypes = t('inquiryTypes', []);

    const { data, setData, post, processing, errors, reset, wasSuccessful } = useForm({
        name: '',
        contact: '',
        email: '',
        referal: '',
        message: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post('/contact/send', {
            preserveScroll: true,
            onSuccess: () => reset(),
        });
    };

    return (
        <section className="relative overflow-hidden bg-kinari py-24 lg:py-32">
            <div aria-hidden="true" className="shima pointer-events-none absolute inset-0 opacity-60" />

            <div className="relative mx-auto max-w-[1500px] px-6 lg:px-8 xl:px-14">
                <div className="flex flex-col gap-6 border-b border-sumi-900/12 pb-10 lg:flex-row lg:items-end lg:justify-between">
                    <SectionHeading no={no} title={t('contact.form.title')} accent={t('contact.form.accent')} />
                    <p className="max-w-md text-sm leading-loose text-nezumi-500">{t('contact.form.intro')}</p>
                </div>

                <div className="grid gap-14 pt-14 lg:grid-cols-[1.1fr_0.9fr] lg:gap-20">
                    <Reveal>
                        <form onSubmit={submit} className="flex flex-col gap-5" noValidate>
                            <div className="grid gap-5 sm:grid-cols-2">
                                <Field
                                    label={t('contact.form.name')}
                                    accent={t('contact.form.nameAccent')}
                                    error={errors.name}
                                >
                                    <input
                                        type="text"
                                        className={FIELD}
                                        placeholder={t('contact.form.namePlaceholder')}
                                        value={data.name}
                                        onChange={(e) => setData('name', e.target.value)}
                                    />
                                </Field>

                                <Field
                                    label={t('contact.form.contact')}
                                    accent={t('contact.form.contactAccent')}
                                    error={errors.contact}
                                >
                                    <input
                                        type="tel"
                                        className={FIELD}
                                        placeholder="+977 …"
                                        value={data.contact}
                                        onChange={(e) => setData('contact', e.target.value)}
                                    />
                                </Field>
                            </div>

                            <Field
                                label={t('contact.form.email')}
                                accent={t('contact.form.emailAccent')}
                                error={errors.email}
                            >
                                <input
                                    type="email"
                                    className={FIELD}
                                    placeholder="you@example.com"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                />
                            </Field>

                            <Field
                                label={t('contact.form.inquiry')}
                                accent={t('contact.form.inquiryAccent')}
                                error={errors.referal}
                            >
                                <select
                                    className={`${FIELD} appearance-none`}
                                    value={data.referal}
                                    onChange={(e) => setData('referal', e.target.value)}
                                >
                                    <option value="" disabled>
                                        {t('contact.form.select')}
                                    </option>
                                    {inquiryTypes.map((type) => (
                                        <option key={type.value} value={type.value}>
                                            {type.title}
                                        </option>
                                    ))}
                                </select>
                            </Field>

                            <Field
                                label={t('contact.form.message')}
                                accent={t('contact.form.messageAccent')}
                                error={errors.message}
                            >
                                <textarea
                                    rows={5}
                                    className={`${FIELD} resize-y`}
                                    placeholder={t('contact.form.messagePlaceholder')}
                                    value={data.message}
                                    onChange={(e) => setData('message', e.target.value)}
                                />
                            </Field>

                            <button
                                type="submit"
                                disabled={processing}
                                className="group mt-2 inline-flex w-fit items-center gap-3 border border-sumi-900 bg-sumi-900 px-10 py-4 text-[0.75rem] font-medium tracking-[0.24em] text-washi transition-colors duration-500 hover:border-shu-600 hover:bg-shu-600 disabled:cursor-not-allowed disabled:opacity-55"
                            >
                                {processing ? t('contact.form.sending') : t('contact.form.send')}
                                <span
                                    aria-hidden="true"
                                    className="transition-transform duration-500 group-hover:translate-x-1.5"
                                >
                                    →
                                </span>
                            </button>

                            {wasSuccessful && (
                                <p className="text-sm text-kon-700">{t('contact.form.success')}</p>
                            )}
                        </form>
                    </Reveal>

                    <Reveal delay={120} className="flex flex-col gap-8">
                        <div className="flex flex-col gap-6 border border-sumi-900/12 bg-washi p-8">
                            <OfficeBlock
                                title={t('footer.nepalOffice')}
                                lines={[company.address]}
                                links={[
                                    { label: company.phone, href: `tel:${company.phone.replace(/\s/g, '')}` },
                                    { label: company.email, href: `mailto:${company.email}` },
                                ]}
                            />
                            <span aria-hidden="true" className="h-px w-full bg-sumi-900/10" />
                            <OfficeBlock
                                title={t('footer.japanBranch')}
                                lines={[company.japan.postal, company.japan.address]}
                                links={[
                                    {
                                        label: company.japan.phone,
                                        href: `tel:${company.japan.phone.replace(/\s/g, '')}`,
                                    },
                                ]}
                            />
                        </div>

                        {withMap && (
                            <div className="relative aspect-[4/3] w-full border border-sumi-900/12 grayscale transition-[filter] duration-700 hover:grayscale-0">
                                <iframe
                                    src={MAP_SRC}
                                    title={t('footer.nepalOffice')}
                                    className="h-full w-full"
                                    style={{ border: 0 }}
                                    allowFullScreen
                                    loading="lazy"
                                    referrerPolicy="no-referrer-when-downgrade"
                                />
                            </div>
                        )}
                    </Reveal>
                </div>
            </div>
        </section>
    );
}

function Field({ label, accent, error, children }) {
    return (
        <label className="flex flex-col gap-2">
            <span className="flex items-baseline gap-2">
                <span className="font-mincho text-[0.85rem] tracking-[0.12em] text-sumi-900">{label}</span>
                <span className="text-[0.58rem] tracking-[0.24em] text-nezumi-400">{accent}</span>
            </span>
            {children}
            {error && <span className="text-xs text-shu-700">{error}</span>}
        </label>
    );
}

function OfficeBlock({ title, lines, links }) {
    return (
        <div className="flex flex-col gap-2.5">
            <div className="flex items-baseline gap-3">
                <span aria-hidden="true" className="h-px w-6 bg-shu-500" />
                <span className="font-mincho text-lg tracking-[0.1em] text-sumi-900">{title}</span>
            </div>
            {lines.map((line) => (
                <p key={line} className="text-sm leading-relaxed text-nezumi-500">
                    {line}
                </p>
            ))}
            <div className="flex flex-col gap-1 pt-1">
                {links.map((link) => (
                    <a
                        key={link.href}
                        href={link.href}
                        className="ink-link w-fit text-sm text-kon-700 hover:text-shu-600"
                    >
                        {link.label}
                    </a>
                ))}
            </div>
        </div>
    );
}
