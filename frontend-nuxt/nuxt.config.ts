import { defineNuxtConfig } from "nuxt/config";

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  modules: ['@pinia/nuxt'],
css: ['~/assets/css/main.css', 'primeicons/primeicons.css'],
  runtimeConfig: {
    public: {
      apiBase: 'http://localhost:8000/api'
    }
  },

  vite: {
    define: {
      'process.env.DEBUG': false,
    }
  }
})

