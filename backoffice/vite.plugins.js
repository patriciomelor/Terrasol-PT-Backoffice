import vue from '@vitejs/plugin-vue';

export function createVitePlugins() {
  return [
    vue(), // Agrega el plugin de Vue
    // Agrega otros plugins aquí
  ];
}