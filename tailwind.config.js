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
            primary: '#2B6CB0', 
            secondary: '#68D391',
            background: '#EDF2F7',
            success: '#48BB78', 
            info: '#63B3ED', 
            warning: '#F6E05E', 
            danger: '#F56565', 
            dark: '#2D3748', 
            background: '#f3f4f6',
            customGreen: '#009688', 
            customGreenDark: '#00796b', 
          },
        },
      },
      variants: {
        extend: {},
      },
      plugins: [],
    };