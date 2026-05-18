/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    "./public/**/*.php",
    "./app/Views/**/*.php",
    "./public/assets/js/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          50:  "#eff8ff",
          100: "#dceffd",
          200: "#b2dffb",
          300: "#7ec7f8",
          400: "#42a8f1",
          500: "#1d8be0",
          600: "#106ebd",
          700: "#0f5899",
          800: "#114a7e",
          900: "#133e69",
        },
      },
      fontFamily: {
        sans: ["Inter", "ui-sans-serif", "system-ui", "sans-serif"],
      },
    },
  },
  plugins: [
    require("@tailwindcss/forms"),
    require("@tailwindcss/typography"),
  ],
};
