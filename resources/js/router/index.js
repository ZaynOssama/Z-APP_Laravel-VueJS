import { createRouter, createWebHistory } from 'vue-router';

const TableComponent = () => import ('../components/TableComponent.vue');

const routes=[
    {
        path:'/users',
        name:'users',
        component:TableComponent
    },
];

const router = createRouter({
 history: createWebHistory(import.meta.env.BASE_URL),
 routes
});

export default router;
