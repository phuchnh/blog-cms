import Vue from 'vue';
import Router from 'vue-router';
import Admin from '@/view/Admin';
import Dashboard from '@/view/Dashboard';
import PageNotFound from '@/view/PageNotFound';

Vue.use(Router);

export function createRouter() {
    return new Router({
        base: __dirname,
        mode: 'history',
        routes: [
            {
                path: '/admin',
                name: 'admin',
                component: Admin,
                redirect: { name: 'dashboard' },
                children: [
                    { path: 'dashboard', name: 'dashboard', component: Dashboard },
                    { path: '*', name: 'pageNotFound', component: PageNotFound }
                ]
            }
        ]
    });
}