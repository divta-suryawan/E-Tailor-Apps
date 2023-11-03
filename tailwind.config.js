/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'tailor-50': '#FFE8EA',
        'tailor-100': '#CC636F',
        'tailor-200': '#BA515D',
      },
    },
  },
  plugins: [],
}

