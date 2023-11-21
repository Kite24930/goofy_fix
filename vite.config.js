import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        rollupOptions: {
            input: {
                app: 'resources/js/app.js',
                appCss: 'resources/css/app.css',
                index: 'resources/js/index.js',
                indexCss: 'resources/css/index.css',
            }
        }
    }
});
