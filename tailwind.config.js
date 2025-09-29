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
      fontSize: {
        basic: '16px',
      },
      extend: {
        fontFamily: {
          sans: ['Figtree', ...defaultTheme.fontFamily.sans],
          roboto: ['Roboto'],
          museo: ['MuseoModerno'],
          owners_trial_wide_xblack: ['Owners TRIAL Wide XBlack'],
          owners_trial_wide_medium: ['Owners TRIAL Wide Medium'],
          owners_trial_xnarrowxblack: ['owners_trial_xnarrowxblack']
        },
        screens: {
          'tablet': {'max': '640px'},
          // => @media (min-width: 640px) { ... }

          'laptop': {'max': '1024px'},
          // => @media (min-width: 1024px) { ... }

          'desktop': {'max': '1280px'},
          // => @media (min-width: 1280px) { ... }
        },
        colors: {
          'primary-black': '#000',
          'primary-white': '#fff',
          'primary-pink': '#ff00c6',
          'primary-yellow': '#fff100',
          'primary-yellow-2': '#E7DA00',
          'primary-green': '#2BB602',
          'primary-red': '#FF0909',
        }
      },
    },

    plugins: [forms],
};
