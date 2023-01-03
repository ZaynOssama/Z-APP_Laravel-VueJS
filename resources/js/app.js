import './bootstrap';
import 'datatables.net-bs5/js/dataTables.bootstrap5.js';
import 'datatables.net-bs5/css/datatables.bootstrap5.min.css';
import 'jquery/dist/jquery.min.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue/dist/vue.esm-bundler';
import RouterWeb from './router/index'
//import BootstrapVue from 'bootstrap-vue'
import CreateUser from './components/ModalCreate.vue';
/*import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
*/

const app = createApp({});

app.component('create-user', CreateUser)

app.use(RouterWeb);

app.mount('#app');
