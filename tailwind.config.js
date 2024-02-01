import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.vue",
  ],

  // prettier-ignore
  theme: {
    extend: {
      colors: {
        'primary': '#f8ead6',
        'brown': '#69442e',
        'bronze': '#9d8461',
        'sandy': '#cfbda6',
        'light-brown': '#ceb68b',
        'blue': '#2e4269',
        'red': '#9e442e'
      },
      fontFamily: {
        sans: ["Figtree", ...defaultTheme.fontFamily.sans],
        serif: ["Averia Serif Libre", ...defaultTheme.fontFamily.serif],
      },
    },
  },

  plugins: [forms],
};
