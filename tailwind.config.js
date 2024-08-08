import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import daisyui from 'daisyui';

/** @type {import("tailwindcss").Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    extend: {
      boxShadow: {
        paper: '1px 1px 3px rgba(0,0,0,0.2), 1px 1px 2px rgba(0,0,0,0.3)',
      },
      colors: {
        primary: '#f8ead6',
        accent: '#6e2e42',
        brown: '#69442e',
        bronze: '#9d8461',
        sandy: '#cfbda6',
        tan: '#ceb68b',
        blue: '#2e4269',
        red: '#9e442e',
        green: '#608c6e',
        'dark-primary': '#1c1713',
        'dark-accent': '#8d3b54',
        'dark-brown': '#7a5037',
        'dark-bronze': '#b39b76',
        'dark-sandy': '#a08e79',
        'dark-tan': '#9e8b69',
        'dark-blue': '#3a547f',
        'dark-red': '#b85339',
        'dark-green': '#70a182',
      },
      fontFamily: {
        serif: ['Fraunces', ...defaultTheme.fontFamily.serif],
      },
    },
  },
  plugins: [forms, daisyui],
  daisyui: {
    styled: true,
    themes: [],
    logs: false,
  },
  darkMode: 'class',
};
