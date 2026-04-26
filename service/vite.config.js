import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

const rawBase = process.env.VITE_BASE_URL || '/';
const normalizedBase = rawBase.endsWith('/') ? rawBase : `${rawBase}/`;

export default defineConfig({
    base: normalizedBase,
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
