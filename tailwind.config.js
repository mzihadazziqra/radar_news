import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
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
                'primary': {
                    DEFAULT: '#D9374A',
                    'dark': '#B82C3D'
                },
                'secondary': '#1E293B',
                'light-gray': '#F3F4F6',
                'medium-gray': '#6B7280',
            }
        },
    },

    plugins: [forms],
};
