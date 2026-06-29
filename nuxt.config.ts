// nuxt.config.ts
export default defineNuxtConfig({
  devtools: { enabled: true },

  modules: [
    ['@nuxtjs/color-mode', {
      classSuffix: '',
      preference: 'dark',
      fallback: 'dark',
    }],
    '@vueuse/nuxt',
    'nuxt-icon',
    ['@nuxtjs/i18n', {
      locales: [
        { code: 'fr', file: 'fr.json' },
        { code: 'en', file: 'en.json' },
      ],
      defaultLocale: 'fr',
      lazy: true,
      langDir: 'locales',
      strategy: 'no_prefix',
      restructureDir: 'i18n',
    }],
  ],

  css: ['~/assets/css/main.css'],

  app: {
    head: {
      title: 'Koladé Aboudou — Développeur Full Stack',
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        {
          name: 'description',
          content:
            'Développeur Full Stack TypeScript — Next.js, NestJS, Nuxt 3. Basé à Cotonou, disponible en remote.',
        },
        { property: 'og:title', content: 'Koladé Aboudou — Développeur Full Stack' },
        {
          property: 'og:description',
          content: 'Next.js · NestJS · Nuxt 3 · TypeScript. Remote-ready.',
        },
        { name: 'theme-color', content: '#0ea5e9' },
      ],
      link: [
        { rel: 'icon', type: 'image/svg+xml', href: '/favicon.svg' },
      ],
    },
    pageTransition: { name: 'page', mode: 'out-in' },
  },

  compatibilityDate: '2024-07-01',
})
