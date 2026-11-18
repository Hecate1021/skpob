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
    safelist: [
    { pattern: /(bg|text|border)-(emerald|blue|amber|purple)-(700|900)/ },
],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                sk: {
                    green: '#059669', // Emerald 600
                    darkgreen: '#047857', // Emerald 700
                    yellow: '#FBBF24', // Amber 400
                    lightyellow: '#FDE68A', // Amber 200
                }
            }
        },
    },
    plugins: [],
};
