/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.{html,php,js}",
    "./pages/**/*.{html,php,js}",
    "./includes/**/*.{html,php,js}",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('daisyui'),
  ],
}