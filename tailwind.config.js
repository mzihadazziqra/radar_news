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
                    'light': '#F3A3AD',
                    'dark': '#B82C3D'
                },
                'secondary': '#1E293B',
                'light-gray': '#F3F4F6',
                'medium-gray': '#6B7280',
            },
            typography: ({ theme }) => ({
                DEFAULT: { // Gaya untuk mode terang (saat hanya 'prose' digunakan)
                    css: {
                        '--tw-prose-body': theme('colors.gray.700'), // Warna teks paragraf utama
                        '--tw-prose-headings': theme('colors.gray.900'), // Warna untuk semua heading (h1-h6)
                        '--tw-prose-lead': theme('colors.gray.600'),
                        '--tw-prose-links': theme('colors.primary.DEFAULT'), // Warna link menggunakan warna primer
                        '--tw-prose-bold': theme('colors.gray.900'),
                        '--tw-prose-counters': theme('colors.gray.500'),
                        '--tw-prose-bullets': theme('colors.gray.300'),
                        '--tw-prose-hr': theme('colors.gray.200'),
                        '--tw-prose-quotes': theme('colors.gray.900'),
                        '--tw-prose-quote-borders': theme('colors.gray.200'),
                        '--tw-prose-captions': theme('colors.gray.500'),
                        '--tw-prose-code': theme('colors.gray.900'),
                        '--tw-prose-pre-code': theme('colors.gray.200'),
                        '--tw-prose-pre-bg': theme('colors.gray.800'), // Latar blok kode
                        '--tw-prose-th-borders': theme('colors.gray.300'),
                        '--tw-prose-td-borders': theme('colors.gray.200'),
                        // Kamu bisa tambahkan lebih banyak kustomisasi di sini
                    },
                },
                invert: { // Gaya untuk mode gelap (saat 'dark:prose-invert' digunakan)
                    css: {
                        '--tw-prose-body': theme('colors.gray.300'), // Warna teks paragraf di mode gelap
                        '--tw-prose-headings': theme('colors.white'),
                        '--tw-prose-lead': theme('colors.gray.400'),
                        '--tw-prose-links': theme('colors.primary.light'), // Warna link di mode gelap (gunakan primary-light jika ada)
                        '--tw-prose-bold': theme('colors.white'),
                        '--tw-prose-counters': theme('colors.gray.400'),
                        '--tw-prose-bullets': theme('colors.gray.600'),
                        '--tw-prose-hr': theme('colors.gray.700'),
                        '--tw-prose-quotes': theme('colors.gray.100'),
                        '--tw-prose-quote-borders': theme('colors.gray.700'),
                        '--tw-prose-captions': theme('colors.gray.400'),
                        '--tw-prose-code': theme('colors.white'),
                        '--tw-prose-pre-code': theme('colors.gray.300'),
                        '--tw-prose-pre-bg': theme('colors.gray.900'), // Latar blok kode di mode gelap
                        '--tw-prose-th-borders': theme('colors.gray.600'),
                        '--tw-prose-td-borders': theme('colors.gray.700'),
                    },
                },
            }),
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography')
    ],
};
