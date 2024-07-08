/** @type {import('tailwindcss').Config} */

import headlessUiTailwindCss from '@headlessui/tailwindcss'
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: '#00A19D',
                secondary: '#FF6F61',
                accent: '#FFD700',
                background: '#F8F8F8',
                text: '#2F4F4F',
                'navbar-link': '#111827',
            },
            fontFamily: {
                sans: ['Roboto', 'sans-serif'],
                serif: ['Playfair Display', 'serif'],
            },
        },
    },
    plugins: [
        headlessUiTailwindCss,
    ],
}

