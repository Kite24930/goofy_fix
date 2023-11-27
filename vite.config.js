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
                edit: 'resources/js/edit.js',
                editCss: 'resources/css/edit.css',
                contentEditCss: 'resources/css/content_edit.css',
                headerLogo: 'resources/js/headerLogo.js',
                slick: 'resources/js/slick.js',
                welcome: 'resources/js/welcome.js',
                concept: 'resources/js/concept.js',
                address: 'resources/js/address.js',
                price: 'resources/js/price.js',
                section: 'resources/js/section.js',
                food: 'resources/js/food.js',
                foodTruck: 'resources/js/food_truck.js',
                sponsor: 'resources/js/sponsor.js',
            }
        }
    }
});
