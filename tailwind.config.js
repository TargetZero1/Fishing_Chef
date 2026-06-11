/** @type {import('tailwindcss').Config} */
export default {
    content: ['./resources/**/*.blade.php', './resources/**/*.js', './resources/**/*.vue'],
    theme: {
        extend: {
            colors: {
                steam: {
                    50: '#f3ead2',
                    100: '#ddc8a0',
                    200: '#c2a572',
                    300: '#a27f4e',
                    700: '#3d2f1d',
                    800: '#2c2015',
                    900: '#18110c',
                    950: '#100a07',
                },
            },
        },
    },
};
