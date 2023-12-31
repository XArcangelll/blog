import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';


/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './src/**/*.{html,js}', 
    ],
    safelist: [
        'bg-red-600',
        'bg-blue-600',
        'bg-orange-600',
        'bg-yellow-600',
        'bg-green-600',
        'bg-pink-600',
        'bg-purple-600',
        'bg-indigo-600',
        'bg-gray-700',
        'text-white',
        'text-gray-300',
        'h-72'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            
        },
    },

    plugins: [forms, typography],
    corePlugins: {
          // ...
          container: false,
        },
      
};
