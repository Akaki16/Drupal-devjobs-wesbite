/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["**/*.twig", "../../../**/*.twig"],
  darkMode: "class",
  theme: {
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '976px',
      'xl': '1440px'
    },
    extend: {},
  },
  plugins: [],
}