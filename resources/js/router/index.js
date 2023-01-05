import { createRouter, createWebHistory } from 'vue-router';

const UserTableComponent = () => import ('../components/UserTableComponent.vue');
const TaskTableComponent = () => import ('../components/TaskTableComponent.vue');

const routes=[
    {
        path:'/users',
        name:'users',
        component:UserTableComponent
    },
    {
        path:'/tasks',
        name:'tasks',
        component:TaskTableComponent
    },
];

const router = createRouter({
 history: createWebHistory(import.meta.env.BASE_URL),
 routes
});

export default router;
