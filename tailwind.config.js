import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import("tailwindcss").Config} */
export default {
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.vue",
  ],

  // prettier-ignorer
  theme: {
    extend: {
      boxShadow: {
        paper: "1px 1px 3px rgba(0,0,0,0.2), 1px 1px 2px rgba(0,0,0,0.3)",
      },
      colors: {
        primary: "#f8ead6",
        brown: "#69442e",
        bronze: "#9d8461",
        sandy: "#cfbda6",
        "light-brown": "#ceb68b",
        blue: "#2e4269",
        red: "#9e442e",
      },
      fontFamily: {
        serif: ["Fraunces", ...defaultTheme.fontFamily.serif],
      },
    },
  },

  plugins: [forms],
};
