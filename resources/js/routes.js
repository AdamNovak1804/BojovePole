import Home from './components/Home';
import Intro from './components/Intro';
import Map from './components/Map';
import Data from './components/Data';
import Account from './components/Account';
import Login from './components/Login';
import Registration from './components/Registration';
import DataPagination from './components/DataPagination';
import AddForm from './components/AddForm';
import Dashboard from './components/Dashboard';

export default
{
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
            path: '/ucet',
            component: Account,
            children: [
                {
                    path: '/prihlasenie',
                    component: Login
                },
                {
                    path: '/registracia',
                    component: Registration
                }
            ]
        },
        {
            path: '/ucet',
            component: Dashboard,
            name: 'Ucet'
        }
    ]

}
