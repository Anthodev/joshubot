/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "./node_modules/tw-elements/dist/js/**/*.js",
  ],
  theme: {
    extend: {},
    safelist: ['animate-[fade-in-up_1s_ease-in-out]'],
  },
  plugins: [
    require("tw-elements/dist/plugin.cjs"),
  ],
  darkMode: "class",
};
