import Home from './components/Home';
import Intro from './components/Intro';
import Map from './components/Map';
import Data from './components/Data';
import Login from './components/Login';
import Registration from './components/Registration';
import DataPagination from './components/DataPagination';
import AddForm from './components/AddForm';
import Dashboard from './components/Dashboard/Dashboard';
import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/domov',
            component: Home
        },
        {
            path: '/uvod',
            component: Intro
        },
        {
            path: '/mapa',
            component: Map
        },
        {
            path: '/data',
            component: Data
        },
        {
            path: '/data/boje',
            component: DataPagination
        },
        {
            path: '/pridat',
            component: AddForm
        },
        {
            path: '/prihlasenie',
            component: Login,
            name: 'Login'
        },
        {
            path: '/registracia',
            component: Registration,
            name: 'Registration'
        },
        {
            path: '/ucet',
            component: Dashboard,
            name: 'Ucet',
            beforeEnter: (to, from, next) => {
                axios.get('api/authenticated').then(() => {
                    next()
                }).catch(() => {
                    return next({ name: 'Login' })
                })
            }
        }
    ]

})
