export default {
  target: "static",

  // Global page headers
  head: {
    title: "Destinology - Luxury Holidays & Travel",
    htmlAttrs: {
      lang: "en",
    },
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      {
        hid: "description",
        name: "description",
        content: "Luxury holidays and travel experiences with Destinology",
      },
      { name: "format-detection", content: "telephone=no" },
    ],
    link: [
      {
        rel: "icon",
        type: "image/x-icon",
        href: "https://www.destinology.co.uk/favicon.ico",
      },
      { rel: "preconnect", href: "//fonts.googleapis.com" },
      { rel: "preconnect", href: "//fonts.gstatic.com" },
      {
        rel: "stylesheet",
        href: "https://use.typekit.net/qnw1adk.css",
        defer: true,
      },
    ],
  },

  // Global CSS
  // css: ["~/assets/css/main.css"],
  css: [
    "~/assets/css/style.css",
    "~/assets/css/custom.css",
    "~/assets/css/flights.css",
  ],

  // Auto import components
  components: true,

  // Modules for dev and build (recommended)
  buildModules: [],

  // Modules
  modules: [],

  // Build Configuration
  build: {},

  // Development server configuration
  server: {
    port: 3000,
    host: "0.0.0.0",
  },

  // Generate configuration for static deployment
  generate: {
    fallback: true,
  },
};
