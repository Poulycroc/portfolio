import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  css: {
    preprocessorOptions: {
      scss: {
        silenceDeprecations: ['global-builtin'],
      },
    },
  },
  build: {
    outDir: '.',
    emptyOutDir: false,
    rollupOptions: {
      input: {
        layouts: resolve(__dirname, 'assets/js/app.js'),
      },
      output: {
        entryFileNames: 'scripts/[name].js',
        chunkFileNames: 'scripts/[name].js',
        assetFileNames: (assetInfo) => {
          if (assetInfo.name?.endsWith('.css')) {
            return 'styles/[name].css';
          }
          return 'assets/[name][extname]';
        },
      },
    },
  },
});
