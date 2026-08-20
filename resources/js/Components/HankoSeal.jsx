import { useI18n } from '../lib/i18n';

/**
 * 判子 — the vermillion seal a Japanese company stamps on approved documents.
 * Here it carries the government licence number, which is the single most
 * important trust signal a Nepali manpower agency has.
 */
export default function HankoSeal({ license, className = '', size = 'md' }) {
    const { t } = useI18n();

    const sizes = {
        sm: 'h-20 w-20 text-[0.5rem]',
        md: 'h-28 w-28 text-[0.58rem]',
        lg: 'h-36 w-36 text-[0.68rem]',
    };

    return (
        <div
            className={`hanko flex-col gap-1 tracking-[0.18em] ${sizes[size] ?? sizes.md} ${className}`}
            title={`${t('common.licenceLabel')} ${license}`}
        >
            <span className="text-[0.85em] tracking-[0.3em] opacity-80">{t('common.sealTop')}</span>
            <span aria-hidden="true" className="h-px w-8 bg-shu-600/60" />
            <span className="numeral font-semibold leading-tight">{license}</span>
            <span className="text-[0.78em] tracking-[0.2em] opacity-70">{t('common.sealBottom')}</span>
        </div>
    );
}
