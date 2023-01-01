import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue/dist/vue.esm-bundler';
import RouterWeb from './router/index'
//import BootstrapVue from 'bootstrap-vue'

/*import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
*/

const app = createApp({});

//app.use(BootstrapVue);
app.use(RouterWeb);

app.mount('#app');
