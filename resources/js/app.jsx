import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createRoot } from 'react-dom/client';

const appName = 'WorldWide Recruitment Services';

createInertiaApp({
    // Titles arrive fully formed from the server (Seo::make appends the
    // site name), so this must not append it a second time.
    title: (title) => title || appName,
    resolve: (name) =>
        resolvePageComponent(`./Pages/${name}.jsx`, import.meta.glob('./Pages/**/*.jsx')),
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
    progress: {
        color: '#fe6601',
        showSpinner: false,
    },
});
