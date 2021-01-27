import Home from './components/Home.vue';
import Explorador from './components/Explorador.vue';
import Profesionales from './components/Profesionales.vue';
import Perfil from './components/Perfil.vue';
import Tareas from './components/Tareas.vue';
import VueRouter from 'vue-router';

const originalPush = VueRouter.prototype.push;
VueRouter.prototype.push = function push(location) {
    return originalPush.call(this, location).catch(err => err);
}

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'login',
        path: '/login',
        component: Home
    },
    {
        name: 'explorador',
        path: '/explorador',
        component: Explorador
    },
    {
        name: 'profesionales',
        path: '/profesionales',
        component: Profesionales
    },
    {
        name: 'tareas',
        path: '/tareas',
        component: Tareas
    },
    {
        name: 'perfil',
        path: '/perfil',
        component: Perfil
    }
];