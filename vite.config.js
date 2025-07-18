import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/login.css',
                'resources/css/crearUsuario.css',
                'resources/css/admin.css',
                'resources/css/preguntas.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
