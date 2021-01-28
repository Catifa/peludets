import Home from './components/Home.vue';
import Explorador from './components/Explorador.vue';
import Profesionales from './components/Profesionales.vue';
import Perfil from './components/Perfil.vue';
import Tareas from './components/Tareas.vue';
import VueRouter from 'vue-router';
import axios from 'axios';

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
        path :'*',
        component:Home
    },
    {
        name: 'myProfile',
        path: '/myProfile',
        component: Perfil,
        beforeEnter: (to, form, next) =>{
            axios.get('/api/authentication').then(() => {
                next();
            }).catch(() => {
                return next({name: 'home'})
            })
        } 
    }
];