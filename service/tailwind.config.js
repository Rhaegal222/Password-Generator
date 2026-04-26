import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                wr: {
                    canvas: '#0b1118',
                    surface: '#121a24',
                    elevated: '#17212d',
                    'border-subtle': '#233142',
                    'border-strong': '#2d4157',
                    'text-primary': '#e6edf5',
                    'text-secondary': '#a9b7c7',
                    'accent-primary': '#2c9fd6',
                    'accent-hover': '#36b8ff',
                    success: '#2fa36b',
                    warning: '#d39a2c',
                    danger: '#c85151',
                    info: '#3a8fd1',
                }
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
