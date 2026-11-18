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
                    // Hot Magenta Pink from the poster
                    green: '#e62b85',
                    // Darker Magenta for hover states and dark text
                    darkgreen: '#b81665',

                    // Keeping the yellow accents (matches the "LIBRENG" text in your poster!)
                    yellow: '#FBBF24',
                    lightyellow: '#FDE68A',
                }
            }
        },
    },
    plugins: [],
};
