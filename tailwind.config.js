/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      // The line-clamp utility is now built into Tailwind CSS v3.3.0+
    },
  },
  plugins: [],
} 