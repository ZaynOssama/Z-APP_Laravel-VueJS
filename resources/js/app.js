import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue/dist/vue.esm-bundler';
import RouterWeb from './router/index'

const app = createApp({});

app.use(RouterWeb);

app.mount('#app');
