import Vue from 'vue';
import Router from 'vue-router';
import Admin from '@/view/Admin';
import Dashboard from '@/view/Dashboard';
import PageNotFound from '@/view/PageNotFound';
import FaqList from '@/view/FaqList';
import UserList from './view/UserList';
import UserDetail from './view/UserDetail';
import InThePressNew from './view/InThePressNew';
import InThePressList from './view/InThePressList';
import InThePressDetail from './view/InThePressDetail';
import BlogList from './view/BlogList';
import BlogNew from './view/BlogNew';
import BlogDetail from './view/BlogDetail';

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
                    { path: '*', name: 'pageNotFound', component: PageNotFound },
                    {path: 'users', name: 'userList', component: UserList},
                    {path: 'users/:id', name: 'userDetail', component: UserDetail},
                    {path: 'in-the-press/new', name: 'inThePressNew', component: InThePressNew},
                    {path: 'in-the-press', name: 'inThePressList', component: InThePressList},
                    {path: 'in-the-press/:id', name: 'inThePressDetail', component: InThePressDetail},
                    {path: 'blogs', name: 'blogList', component: BlogList},
                    {path: 'blogs/new', name: 'blogNew', component: BlogNew},
                    {path: 'blogs/:id', name: 'blogDetail', component: BlogDetail},
                ]
            }
        ]
    });
}
