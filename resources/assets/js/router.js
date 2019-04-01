import Vue from 'vue';
import Router from 'vue-router';
import Admin from '@/view/Admin';
import Dashboard from '@/view/Dashboard';
import PageNotFound from '@/view/PageNotFound';
import FaqList from '@/view/FaqList';

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
                meta: { requiredAuth: true },
                redirect: { name: 'dashboard' },
                children: [
                    { path: 'dashboard', name: 'dashboard', component: Dashboard },
                    { path: 'faq', name: 'faq', component: FaqList },
                    { path: '*', name: 'pageNotFound', component: PageNotFound }
                ]
            }
        ]
    });
}