/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",
    "./src/**/*.{php,html,js}",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
      },
      colors: {
        gov: {
          50:  '#eef4fb',
          100: '#d4e2f5',
          200: '#a9c5eb',
          300: '#7ea8e0',
          400: '#4d85cf',
          500: '#2a5a8f',
          600: '#1e3a5f',
          700: '#152d4a',
          800: '#0f2035',
          900: '#0a1520',
        },
        sidebar: {
          DEFAULT: '#1e293b',
          hover:   '#334155',
          active:  '#0f172a',
          text:    '#94a3b8',
          heading: '#64748b',
        },
        accent: {
          50:  '#eff6ff',
          100: '#dbeafe',
          200: '#bfdbfe',
          300: '#93c5fd',
          400: '#60a5fa',
          500: '#3b82f6',
          600: '#2563eb',
          700: '#1d4ed8',
        },
        success: {
          50:  '#f0fdf4',
          100: '#dcfce7',
          500: '#22c55e',
          600: '#16a34a',
          700: '#15803d',
        },
        warning: {
          50:  '#fffbeb',
          100: '#fef3c7',
          500: '#f59e0b',
          600: '#d97706',
          700: '#b45309',
        },
        danger: {
          50:  '#fef2f2',
          100: '#fee2e2',
          500: '#ef4444',
          600: '#dc2626',
          700: '#b91c1c',
        },
      },
      fontSize: {
        '2xs': ['0.65rem', { lineHeight: '0.85rem' }],
      },
    },
  },
  plugins: [],
};
