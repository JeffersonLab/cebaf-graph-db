import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';
import path from 'path';
import { run } from 'vite-plugin-run';

export default defineConfig({
    resolve: {
        alias: {
            ziggy: path.resolve("vendor/tightenco/ziggy/dist/vue.es.js"),
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        run([
            {
                name: 'build ziggy routes',
                run: ['php', 'artisan', 'ziggy:generate'],
                startup: true,
            }
        ]),
    ],
});
