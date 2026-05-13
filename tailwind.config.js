/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
                display: ['Outfit', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('daisyui'),
    ],
    daisyui: {
        themes: [
            {
                inspagenda: {
                    "primary": "#FFC107",
                    "secondary": "#f3f4f6",
                    "accent": "#6366f1",
                    "neutral": "#3D4451",
                    "base-100": "#FFFFFF",
                    "base-content": "#1A1A1B",
                    "info": "#3ABFF8",
                    "success": "#10b981",
                    "warning": "#f59e0b",
                    "error": "#ef4444",
                },
            },
            "dark",
        ],
    },
};
