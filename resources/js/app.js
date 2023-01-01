import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue/dist/vue.esm-bundler'

const app = createApp({});

import HomeComponent from "./components/HomeComponent.vue";

app.component('HomeComponent', HomeComponent);

app.mount("#app")
