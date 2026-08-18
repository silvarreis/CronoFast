import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import basicSsl from '@vitejs/plugin-basic-ssl'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/grid.css', 
                'resources/css/auth.css', 
                'resources/js/app.js',
                'resources/js/auth.js',
                'resources/js/app.js', 
                'resources/js/bootstrap.js'
            ],
            refresh: true,
        }),
        basicSsl()
    ],
    server: {
        // Configura o cliente do Vite para se comunicar apenas via HTTPS
        hmr: {
        host: 'cronofast-wp25u.ondigitalocean.app',
        protocol: 'wss', // WebSocket Seguro
        },
    },
});
