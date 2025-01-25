/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",         // File PHP di root tema
    "./template-parts/**/*.php", // Template parts
    "./templates/**/*.php", // Template parts
    "./asset/js/**/*.js",       // File JavaScript tema
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};