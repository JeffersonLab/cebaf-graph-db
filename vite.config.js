import { defineConfig } from 'vite';
import path from 'path';
import laravel from 'laravel-vite-plugin';
import inject from "@rollup/plugin-inject";
import { run } from 'vite-plugin-run';

export default defineConfig({
    plugins: [
        inject({   // => that should be first under plugins array
            $: 'jquery',
            jQuery: 'jquery'
        }),
        laravel.default({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        run([
            {
                name: 'copy static css',
                run: ['cp', 'resources/css/*.css', 'public/css/'],
                startup: true,
                silent: false,
            },
            {
                name: 'copy prism.js',
                run: ['cp', 'resources/js/prism.js', 'public/js/'],
                startup: true,
                silent: false,
            },
            run([
                {
                    name: 'clear cached views',
                    run: ['php', 'artisan', 'view:clear'],
                    startup: true,
                    silent: false,
                }
            ]),
        ]),
        // run([
        //     {
        //         name: 'build ziggy routes',
        //         run: ['php', 'artisan', 'ziggy:generate'],
        //         startup: true,
        //     }
        // ]),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap')
        }
    }
});



