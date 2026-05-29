import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                bg: {
                    100: 'var(--bg-100)',
                    200: 'var(--bg-200)',
                    300: 'var(--bg-300)',
                },
                txt: {
                    100: 'var(--text-100)',
                    200: 'var(--text-200)',
                },
                primary: {
                    100: 'var(--primary-100)',
                    200: 'var(--primary-200)',
                    300: 'var(--primary-300)',
                },
                accent: {
                    100: 'var(--accent-100)',
                    200: 'var(--accent-200)',
                },
                status: {
                    success: 'var(--color-status-success)',
                    warning: 'var(--color-status-warning)',
                    danger: 'var(--color-status-danger)',
                }
            },
            boxShadow: {
                'cinematic': 'var(--shadow-cinematic)',
                'cinematic-hover': 'var(--shadow-cinematic-hover)',
                'glow': 'var(--shadow-glow)',
            },
        },
    },

    plugins: [forms],
};
