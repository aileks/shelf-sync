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
        accent: '#6a3d5b',
        brown: '#6f4f28',
        bronze: '#a67b5b',
        sandy: '#d9c2a3',
        tan: '#d6bfa9',
        blue: '#314b6e',
        red: '#b64c47',
        green: '#3c5a4a',
        'dark-primary': '#2a2a2a',
        'dark-accent': '#a54c6a',
        'dark-brown': '#5c3f26',
        'dark-bronze': '#8c6f4d',
        'dark-sandy': '#8c6e5f',
        'dark-tan': '#8f6f50',
        'dark-blue': '#1e3a5f',
        'dark-red': '#8c3a2b',
        'dark-green': '#4a755f',
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
