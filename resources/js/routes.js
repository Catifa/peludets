import Home from './components/Home.vue';
import Explorador from './components/Explorador.vue';
import Comunidad from './components/Comunidad.vue';
import myProfile from './components/Perfil.vue';
import Profile from './components/templates/tmp_perfil.vue';
import Chat from './components/Chat.vue';
import AdminPanel from './components/AdminPanel.vue';
import VueRouter from 'vue-router';
import Api from './Api';
import Privacitat from './components/Privacitat.vue';
import Conducta from './components/Conducta.vue';


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
        name: 'device',
        path: '/device',
        component: Home
    },
    {
        name: 'explorador',
        path: '/explorador',
        component: Explorador
    },
    {
        name: 'comunidad',
        path: '/comunidad',
        component: Comunidad
    },
    {
        name: 'privacitat',
        path: '/privacitat',
        component: Privacitat
    },
    {
        name: 'conducta',
        path: '/conducta',
        component: Conducta
    },
    {
        path: '*',
        component: Home
    },
    {
        name: 'myProfile',
        path: '/myProfile',
        component: myProfile,
        beforeEnter: (to, form, next) => {
            Api().get('/authentication').then(() => {
                next();
            }).catch(() => {
                return next({ name: 'home' })
            })
        }
    },
    {
        name: 'Profile',
        path: '/profile/:id',
        component: Profile
    },
    {
        name: 'Chat',
        path: '/chat',
        component: Chat
    },
    {
        name: 'admin',
        path: '/admin',
        component: AdminPanel
    },
];