module.exports = {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
    "scripts": {
        "build": "postcss asset/css/main.css -o asset/css/style.css --watch"
      }
  };