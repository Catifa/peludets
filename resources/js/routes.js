import Home from './components/Home.vue';
import Explorador from './components/Explorador.vue';
import Profesionales from './components/Profesionales.vue';
import Perfil from './components/Perfil.vue';

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
        name: 'perfil',
        path: '/perfil',
        component: Perfil
    }
];