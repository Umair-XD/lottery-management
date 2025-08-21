import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/swiper.css', 'resources/js/app.js', 'resources/js/tires.js', 'resources/js/products.js', 'resources/js/tickets.js'],
            refresh: true,
        }),
    ],
});
