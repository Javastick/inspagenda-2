/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#FFC107',
        'text-main': '#1A1A1B',
        surface: '#FFFFFF'
      }
    },
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: [
      {
        mytheme: {
          "primary": "#FFC107",
          "base-100": "#FFFFFF",
          "base-content": "#1A1A1B",
        },
      },
    ],
  },
}
