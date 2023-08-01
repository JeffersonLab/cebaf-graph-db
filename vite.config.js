import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';
import inject from "@rollup/plugin-inject";
import path from 'path';
import { run } from 'vite-plugin-run';

export default defineConfig({
    resolve:{
    alias: {
        vue: 'vue/dist/vue.esm.js',
    },
    },
    plugins: [
        inject({   // => that should be first under plugins array
            $: 'jquery',
            jQuery: 'jquery',
        }),
        laravel.default({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
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
        // run([
        //     {
        //         name: 'build ziggy routes',
        //         run: ['php', 'artisan', 'ziggy:generate'],
        //         startup: true,
        //     }
        // ]),
    ],
});



