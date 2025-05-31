/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php"
  ],
  theme: {
    extend: {
      colors: {
        'primary-bg': 'rgb(33, 51, 42)',
        'primary-accent': '#6B7A62',
        'text-light': '#D9C4A4',
        'button-hover': '#4C5B47'
      }
    },
  },
  plugins: [],
}