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
                    canvas: 'var(--wr-color-bg-canvas)',
                    surface: 'var(--wr-color-bg-surface)',
                    elevated: 'var(--wr-color-bg-elevated)',
                    'border-subtle': 'var(--wr-color-border-subtle)',
                    'border-strong': 'var(--wr-color-border-strong)',
                    'text-primary': 'var(--wr-color-text-primary)',
                    'text-secondary': 'var(--wr-color-text-secondary)',
                    'text-disabled': 'var(--wr-color-text-disabled)',
                    'text-on-accent': 'var(--wr-color-text-on-accent)',
                    accent: 'var(--wr-color-accent-primary)',
                    'accent-hov': 'var(--wr-color-accent-hover)',
                    success: 'var(--wr-color-success)',
                    warning: 'var(--wr-color-warning)',
                    danger: 'var(--wr-color-danger)',
                    info: 'var(--wr-color-info)',
                },
            },
            fontFamily: {
                sans: ['var(--wr-font-family-ui)', ...defaultTheme.fontFamily.sans],
                'wr-ui': ['var(--wr-font-family-ui)'],
                'wr-mono': ['var(--wr-font-family-mono)'],
            },
            fontSize: {
                'wr-12': 'var(--wr-font-size-12)',
                'wr-14': 'var(--wr-font-size-14)',
                'wr-16': 'var(--wr-font-size-16)',
                'wr-18': 'var(--wr-font-size-18)',
            },
            borderRadius: {
                'wr-md': 'var(--wr-radius-md)',
                'wr-lg': 'var(--wr-radius-lg)',
            },
            spacing: {
                'wr-8': 'var(--wr-space-8)',
                'wr-16': 'var(--wr-space-16)',
                'wr-24': 'var(--wr-space-24)',
                'wr-32': 'var(--wr-space-32)',
            },
        },
    },
    plugins: [],
};
