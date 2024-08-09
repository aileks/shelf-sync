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
        primary: '#f4e9e2',
        accent: '#a85a8c',
        brown: '#6f4f28',
        bronze: '#a67b5b',
        sandy: '#d9c2a3',
        tan: '#d6bfa9',
        blue: '#1e2a3d',
        red: '#b64c47',
        green: '#3c5a4a',
        'dark-primary': '#2d1a1b',
        'dark-accent': '#6a3d5b',
        'dark-brown': '#5a3a1e',
        'dark-bronze': '#8b6f3c',
        'dark-sandy': '#7a5f47',
        'dark-tan': '#8e6a4d',
        'dark-blue': '#314b6e',
        'dark-red': '#6a2c29',
        'dark-green': '#3f6f58',
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
