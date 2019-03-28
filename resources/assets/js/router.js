import Vue from 'vue';
import Router from 'vue-router';
import Admin from './components/Admin';

Vue.use(Router);

const Foo = { template: '<div>Foo</div>' };
const Dashboard = { template: '<div>Dashboard</div>' };
const Bar = { template: '<div>Bar</div>' };
const PageNotFound = { template: '<div>PageNotFound</div>' };

export function createRouter() {
    return new Router({
        mode: 'history',
        routes: [
            {
                path: '/admin',
                name: 'admin',
                component: Admin,
                redirect: { name: 'dashboard' },
                children: [
                    { path: 'dashboard', name: 'dashboard', component: Dashboard },
                    { path: 'foo', name: 'foo', component: Foo },
                    { path: 'bar', name: 'bar', component: Bar },
                    { path: '*', name: 'pageNotFound', component: PageNotFound }
                ]
            }
        ]
    });
}