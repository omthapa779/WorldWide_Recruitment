import { usePage } from '@inertiajs/react';

/**
 * Reads a dot-path out of the shared `translations` prop.
 *
 *   t('nav.home')            → 'Home' / 'ホーム'
 *   t('servicesList')        → the array of service objects
 *   t('common.positions')    → 'Positions' / '名'
 *
 * A missing key returns the key itself, which makes gaps obvious on screen
 * instead of rendering an empty element.
 */
export function useI18n() {
    const { props } = usePage();
    const translations = props.translations ?? {};
    const locale = props.locale ?? 'en';

    const t = (path, fallback = undefined) => {
        const value = path
            .split('.')
            .reduce((acc, key) => (acc && acc[key] !== undefined ? acc[key] : undefined), translations);

        if (value === undefined) {
            return fallback !== undefined ? fallback : path;
        }
        return value;
    };

    return { t, locale, isJapanese: locale === 'ja' };
}

/**
 * Splits a string on newlines into React-friendly lines. Used for headlines
 * that are deliberately broken across two lines in each language.
 */
export function lines(value) {
    return String(value ?? '').split('\n');
}
