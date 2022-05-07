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

import UnitList from './components/DataLists/UnitList';
import BattleList from './components/DataLists/BattleList';
import CemeteryList from './components/DataLists/CemeteryList';
import LandmarkList from './components/DataLists/LandmarkList';

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/domov',
            name: 'Domovská stránka',
            component: Home
        },
        {
            path: '/uvod',
            name: 'Úvodná stránka',
            component: Intro
        },
        {
            path: '/mapa',
            name: 'Mapa',
            component: Map
        },
        {
            path: '/data',
            component: Data
        },
        {
            path: '/data/zoznam/',
            component: DataPagination,
            children: [
                { path: 'utvary', component: UnitList },
                { path: 'bitky', component: BattleList },
                { path: 'cintoriny', component: CemeteryList },
                { path: 'pamiatky', component: LandmarkList }
            ]
        },
        {
            path: '/pridat',
            component: AddForm
        },
        {
            path: '/prihlasenie',
            name: 'Login',
            component: Login
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
