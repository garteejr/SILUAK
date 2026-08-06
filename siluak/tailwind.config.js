/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'dinas-blue': '#2566A8',
        'dinas-dark': '#1E40AF',
        'dinas-green': '#059669',
      },
    },
  },
  plugins: [],
}
