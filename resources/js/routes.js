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
import CountryList from './components/DataLists/CountryList';

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/domov',
            name: 'Domov',
            component: Home
        },
        {
            path: '/uvod',
            name: 'Úvod',
            component: Intro
        },
        {
            path: '/mapa',
            name: 'Mapa',
            component: Map
        },
        {
            path: '/data',
            name: 'Dáta',
            component: Data
        },
        {
            path: '/data/zoznam/',
            component: DataPagination,
            children: [
                { path: 'utvary', name: 'Zoznam útvarov', component: UnitList },
                { path: 'bitky', name: 'Zoznam bitiek', component: BattleList },
                { path: 'cintoriny', name: 'Zoznam cintorínov', component: CemeteryList },
                { path: 'pamiatky', name: 'Zoznam pamiatok', component: LandmarkList },
                { path: 'krajiny', name: 'Zoznam krajín', component: CountryList }
            ]
        },
        {
            path: '/pridat',
            name: 'Pridanie nového objektu',
            component: AddForm
        },
        {
            path: '/prihlasenie',
            name: 'Prihlásenie',
            component: Login
        },
        {
            path: '/registracia',
            name: 'Registrácia',
            component: Registration
        },
        {
            path: '/ucet',
            name: 'Účet',
            component: Dashboard,
            beforeEnter: (to, from, next) => {
                axios.get('api/authenticated').then(() => {
                    next()
                }).catch(() => {
                    return next({ name: 'Prihlásenie' })
                })
            }
        }
    ]

})
