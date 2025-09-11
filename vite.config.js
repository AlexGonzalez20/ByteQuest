import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/login.css',
                'resources/css/admin.css',
                'resources/css/preguntas.css',
                'resources/css/bootstrap.min.css',
                'resources/css/crudUsuario.css',
                'resources/css/dashboard.css',
                'resources/css/forgot-reset.css',
                'resources/css/landing.css',
                'resources/css/profile.css',
                'resources/css/register.css',
                'resources/css/selectCourse.css',
                'resources/css/style.css',
                'resources/css/usuarios.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
