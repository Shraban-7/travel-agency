/**
 * Design tokens from docs/DESIGN.md
 * Used by the Tailwind Play CDN in these static templates.
 * When moving to the Laravel/Vite build, copy `theme` into the real tailwind.config.js.
 */
tailwind.config = {
  theme: {
    container: {
      center: true,
      padding: { DEFAULT: '1rem', sm: '1.5rem', lg: '2rem' },
      screens: { sm: '640px', md: '768px', lg: '1024px', xl: '1200px' }, // container max 1200px
    },
    extend: {
      colors: {
        primary: {
          50: '#F0FDFA', 100: '#CCFBF1', 200: '#99F6E4', 300: '#5EEAD4', 400: '#2DD4BF',
          500: '#14B8A6', 600: '#0D9488', 700: '#0F766E', 800: '#115E59', 900: '#134E4A', 950: '#042F2E',
          DEFAULT: '#0F766E',
        },
        navy: {
          50: '#EEF5FA', 100: '#D5E6F1', 200: '#A9CAE0', 300: '#74A6C8', 400: '#3F7CA6',
          500: '#215D87', 600: '#164C72', 700: '#0B3B5B', 800: '#092F49', 900: '#062236',
          DEFAULT: '#0B3B5B',
        },
        accent: {
          50: '#FDF8E7', 100: '#FAEDC0', 200: '#F4DB85', 300: '#EDC74F', 400: '#E2B22B',
          500: '#D4A017', 600: '#B07F10', 700: '#8C6110', 800: '#6F4D13', 900: '#5C4014',
          DEFAULT: '#D4A017',
        },
        success: '#16A34A',
        warning: '#F59E0B',
        danger: '#DC2626',
        info: '#0284C7',
        surface: '#F8FAFC',
        ink: '#0F172A',
      },
      fontFamily: {
        sans: ['"Hind Siliguri"', '"Noto Sans Bengali"', 'Inter', 'system-ui', 'sans-serif'],
        en: ['Inter', 'Poppins', 'system-ui', 'sans-serif'],
        serif: ['"Noto Serif Bengali"', 'Georgia', 'serif'],
      },
      boxShadow: {
        soft: '0 1px 2px rgba(15,23,42,.04), 0 8px 24px -10px rgba(15,23,42,.10)',
        lift: '0 2px 4px rgba(15,23,42,.04), 0 22px 44px -16px rgba(15,118,110,.30)',
        gold: '0 10px 30px -10px rgba(212,160,23,.55)',
      },
      borderRadius: { xl: '0.875rem', '2xl': '1.25rem' },
    },
  },
};
