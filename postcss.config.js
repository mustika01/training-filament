const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    plugins: {
        tailwindcss: {
            content: [
                './packages/admin/resources/**/*.blade.php',
                './packages/forms/resources/**/*.blade.php',
                './packages/notifications/resources/**/*.blade.php',
                './packages/support/resources/**/*.blade.php',
                './packages/tables/resources/**/*.blade.php',
                './resources/**/*.blade.php',
                './vendor/filament/**/*.blade.php', 
            ],
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        danger: colors.rose,
                        primary: colors.emerald,
                        success: colors.green,
                        warning: colors.yellow,
                    },
                    fontFamily: {
                        sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
                    },
                },
            },
            plugins: [
                require('@tailwindcss/forms'),
                require('@tailwindcss/typography'),
            ],
        },
        autoprefixer: {},
    },
}