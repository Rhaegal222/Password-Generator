import defaultTheme from 'tailwindcss/defaultTheme';
import wrPreset from '../../wyrmrest/ui-system/packages/ui-tailwind-preset/index.cjs';

/** @type {import('tailwindcss').Config} */
export default {
    presets: [wrPreset],
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
