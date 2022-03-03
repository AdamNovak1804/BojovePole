import Home from './components/Home';
import Intro from './components/Intro';
import Map from './components/Map';
import Data from './components/Data';
import Account from './components/Account';

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
            path: '/ucet',
            component: Account
        }
    ]

}
