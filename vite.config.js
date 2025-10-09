import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        outDir: "public/assets/resource",
        rollupOptions: {
            output: {
                entryFileNames: (chunk) => {
                    if (
                        chunk.facadeModuleId &&
                        chunk.facadeModuleId.includes("resources/js/app.js")
                    ) {
                        return "app.js";
                    }
                    return "[name]-script.js";
                },
                // chunkFileNames: "[name].js",
                assetFileNames: "[name].[ext]",
            },
        },
    },
});
