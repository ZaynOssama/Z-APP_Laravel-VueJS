import { createRouter, createWebHistory } from 'vue-router';

const HomeComponent = () => import ('../components/HomeComponent.vue');
const AboutComponent = () => import ('../components/AboutComponent.vue');

const routes=[
    {
        path:'/dashboard',
        name:'home',
        component:HomeComponent
    },
    {
        path:'/about',
        name:'contacto',
        component:AboutComponent
    }
];

const router = createRouter({
 history: createWebHistory(import.meta.env.BASE_URL),
 routes
});

export default router;
