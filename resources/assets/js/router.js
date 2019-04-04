import Vue from 'vue'
import Router from 'vue-router'
import Admin from '@/view/Admin'
import Dashboard from '@/view/Dashboard'
import PageNotFound from '@/view/PageNotFound'
import FaqList from '@/view/FaqList'
import UserList from '@/view/UserList'
import UserDetail from '@/view/UserDetail'
import InThePressNew from '@/view/InThePressNew'
import InThePressList from '@/view/InThePressList'
import InThePressDetail from '@/view/InThePressDetail'
import BlogList from '@/view/BlogList'
import BlogNew from '@/view/BlogNew'
import BlogDetail from '@/view/BlogDetail'
import ClientList from '@/view/ClientList'
import ClientDetail from '@/view/ClientDetail'
import ClientNew from '@/view/ClientNew'
import FaqDetail from './view/FaqDetail'

Vue.use(Router)

export default new Router({
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
        {
          path: 'dashboard',
          name: 'dashboard',
          component: Dashboard,
          meta: {
            title: 'Dashboard',
            description: '',
          },
        },
        {
          path: 'faq',
          name: 'faqList',
          component: FaqList,
          meta: {
            title: 'FaqList',
            description: '',
          },
        },
        {
          path: 'faq/:id',
          name: 'faqDetail',
          component: FaqDetail,
          meta: {
            title: 'FaqDetail',
            description: '',
          },
        },
        {
          path: 'users',
          name: 'userList',
          component: UserList,
          meta: {
            title: 'UserList',
            description: '',
          },
        },
        {
          path: 'users/:id',
          name: 'userDetail',
          component: UserDetail,
          meta: {
            title: 'UserDetail',
            description: '',
          },
        },

        {
          path: 'in-the-press/new',
          name: 'inThePressNew',
          component: InThePressNew,
          meta: {
            title: 'InThePressNew',
            description: '',
          },
        },
        {
          path: 'in-the-press',
          name: 'inThePressList',
          component: InThePressList,
          meta: {
            title: 'InThePressList',
            description: '',
          },
        },
        {
          path: 'in-the-press/:id',
          name: 'inThePressDetail',
          component: InThePressDetail,
          meta: {
            title: 'InThePressDetail',
            description: '',
          },
        },

        {
          path: 'blogs',
          name: 'blogList',
          component: BlogList,
          meta: {
            title: 'BlogList',
            description: '',
          },
        },
        {
          path: 'blogs/new',
          name: 'blogNew',
          component: BlogNew,
          meta: {
            title: 'BlogNew',
            description: '',
          },
        },
        {
          path: 'blogs/:id',
          name: 'blogDetail',
          component: BlogDetail,
          meta: {
            title: 'BlogDetail',
            description: '',
          },
        },

        {
          path: 'clients',
          name: 'clientList',
          component: ClientList,
          meta: {
            title: 'ClientList',
            description: '',
          },
        },
        {
          path: 'clients/new',
          name: 'clientNew',
          component: ClientNew,
          meta: {
            title: 'ClientNew',
            description: '',
          },
        },
        {
          path: 'clients/:id',
          name: 'clientDetail',
          component: ClientDetail,
          meta: {
            title: 'ClientDetail',
            description: '',
          },
        },

        {
          path: '*',
          name: 'pageNotFound',
          component: PageNotFound,
          meta: {
            title: 'PageNotFound',
            description: '',
          },
        },
      ],
    },
  ],
})
