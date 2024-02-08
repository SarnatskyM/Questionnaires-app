import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/choice.css",
                "resources/css/finish.css",
                "resources/css/index.css",
                "resources/css/media.css",
                "resources/css/reset.css",
                "resources/css/style.css",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
});
