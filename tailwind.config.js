import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#FFDD57',
                    dark: '#E6C347',
                },
                neutral: {
                    DEFAULT: '#4B5563',
                    lighter: '#6B7280',
                    darker: '#374151',
                },
                dark: {
                    DEFAULT: '#1F2937',
                    secondary: '#111827',
                },
            },
        },
    },
    plugins: [],
};
