import Vue from 'vue'
import Router from 'vue-router'
import Admin from '@/view/Admin'
import Dashboard from '@/view/Dashboard'
import PageNotFound from '@/view/PageNotFound'
import UserList from '@/view/UserList'
import UserDetail from '@/view/UserDetail'
import UserNew from '@/view/UserNew'
import ClientList from '@/view/ClientList'
import ClientDetail from '@/view/ClientDetail'
import ClientNew from '@/view/ClientNew'
import Setting from '@/view/Setting'
import CategoryList from '@/view/CategoryList'
import CategoryNew from '@/view/CategoryNew'
import CategoryDetail from '@/view/CategoryDetail'
import PostContainer from '@/view/PostContainer'
import ListPost from './components/ListPost'
import EditPost from './components/EditPost'
import NewPost from './components/NewPost'

Vue.use(Router)

export default new Router({
  base: __dirname,
  mode: 'history',
  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { x: 0, y: 0 }
    }
  },
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
        //==================================================================
        {
          path: 'faqs',
          component: PostContainer,
          props: {
            postType: 'post_faq',
            redirectToNew: 'FaqNew',
            redirectToDetail: 'FaqDetail',
            redirectToList: 'FaqList',
          },
          meta: {
            postType: 'post_faq',
          },
          children: [
            {
              path: '',
              name: 'FaqList',
              component: ListPost,
              meta: {
                title: 'FAQ',
                description: '',
                postType: 'post_faq',
              },
            },
            {
              path: 'new',
              name: 'FaqNew',
              component: NewPost,
              meta: {
                title: 'Create New FAQ',
                description: 'Add new',
                postType: 'post_faq',
              },
            },
            {
              path: ':id',
              name: 'FaqDetail',
              component: EditPost,
              meta: {
                title: 'Edit FAQ',
                description: '',
                postType: 'post_faq',
              },
            },
          ],
        },
        //==================================================================
        {
          path: 'users',
          name: 'userList',
          component: UserList,
          meta: {
            title: 'User',
            description: '',
          },
        },
        {
          path: 'users/new',
          name: 'userNew',
          component: UserNew,
          meta: {
            title: 'Create New User',
            description: '',
          },
        },
        {
          path: 'users/:id',
          name: 'userDetail',
          component: UserDetail,
          meta: {
            title: 'Edit User',
            description: '',
          },
        },

        //=================================== InThePress ==============================//
        {
          path: 'presses',
          component: PostContainer,
          props: {
            postType: 'post_presses',
            redirectToNew: 'InThePressNew',
            redirectToDetail: 'InThePressDetail',
            redirectToList: 'InThePressList',
          },
          meta: {
            postType: 'post_presses',
          },
          children: [
            {
              path: '',
              name: 'InThePressList',
              component: ListPost,
              meta: {
                title: 'In The Press',
                description: 'InThePressList',
                postType: 'post_presses',
              },
            },
            {
              path: 'new',
              name: 'InThePressNew',
              component: NewPost,
              meta: {
                title: 'Create new In The Press',
                description: 'InThePressNew',
                postType: 'post_presses',
              },
            },
            {
              path: ':id',
              name: 'InThePressDetail',
              component: EditPost,
              meta: {
                title: 'Edit In The Press',
                description: 'InThePressDetail',
                postType: 'post_presses',
              },
            },
          ],
        },
        //=================================== InThePress ==============================//

        //=================================== Blogs ==============================//
        {
          path: 'blogs',
          component: PostContainer,
          props: {
            postType: 'post_blogs',
            redirectToNew: 'BlogNew',
            redirectToDetail: 'BlogDetail',
            redirectToList: 'BlogList',
          },
          meta: {
            postType: 'post_blogs',
          },
          children: [
            {
              path: '',
              name: 'BlogList',
              component: ListPost,
              meta: {
                title: 'Blog',
                description: 'BlogList',
                postType: 'post_blogs',
              },
            },
            {
              path: 'new',
              name: 'BlogNew',
              component: NewPost,
              meta: {
                title: 'Create New Blog',
                description: 'BlogNew',
                postType: 'post_blogs',
              },
            },
            {
              path: ':id',
              name: 'BlogDetail',
              component: EditPost,
              meta: {
                title: 'Edit Blog',
                description: 'BlogDetail',
                postType: 'post_blogs',
              },
            },
          ],
        },
        //=================================== Blogs ==============================//

        {
          path: 'clients',
          name: 'clientList',
          component: ClientList,
          meta: {
            title: 'Client',
            description: '',
          },
        },
        {
          path: 'clients/new',
          name: 'clientNew',
          component: ClientNew,
          meta: {
            title: 'Create New Client',
            description: '',
          },
        },
        {
          path: 'clients/:id',
          name: 'clientDetail',
          component: ClientDetail,
          meta: {
            title: 'Edit Client',
            description: '',
          },
        },

        //=================================== Guides ==============================//
        {
          path: 'guides',
          component: PostContainer,
          props: {
            postType: 'post_guides',
            redirectToNew: 'GuideNew',
            redirectToDetail: 'GuideDetail',
            redirectToList: 'GuideList',
          },
          meta: {
            postType: 'post_guides',
          },
          children: [
            {
              path: '',
              name: 'GuideList',
              component: ListPost,
              meta: {
                title: 'Guide',
                description: 'GuideList',
                postType: 'post_guides',
              },
            },
            {
              path: 'new',
              name: 'GuideNew',
              component: NewPost,
              meta: {
                title: 'Create New Guide',
                description: 'GuideNew',
                postType: 'post_guides',
              },
            },
            {
              path: ':id',
              name: 'GuideDetail',
              component: EditPost,
              meta: {
                title: 'Edit Guide',
                description: 'GuideDetail',
                postType: 'post_guides',
              },
            },
          ],
        },
        //=================================== Guides ==============================//

        //=================================== Events ==============================//
        {
          path: 'events',
          component: PostContainer,
          props: {
            postType: 'post_events',
            redirectToNew: 'EventNew',
            redirectToDetail: 'EventDetail',
            redirectToList: 'EventList',
          },
          meta: {
            postType: 'post_events',
          },
          children: [
            {
              path: '',
              name: 'EventList',
              component: ListPost,
              meta: {
                title: 'Event',
                description: 'EventList',
                postType: 'post_events',
              },
            },
            {
              path: 'new',
              name: 'EventNew',
              component: NewPost,
              meta: {
                title: 'Create New Event',
                description: 'EventNew',
                postType: 'post_events',
              },
            },
            {
              path: ':id',
              name: 'EventDetail',
              component: EditPost,
              meta: {
                title: 'Edit Event',
                description: 'EventDetail',
                postType: 'post_events',
              },
            },
          ],
        },
        //=================================== Events ==============================//

        //=================================== Pratices ==============================//
        {
          path: 'pratices',
          component: PostContainer,
          props: {
            postType: 'post_pratices',
            redirectToNew: 'PraticeNew',
            redirectToDetail: 'PraticeDetail',
            redirectToList: 'PraticeList',
          },
          meta: {
            postType: 'post_pratices',
          },
          children: [
            {
              path: '',
              name: 'PraticeList',
              component: ListPost,
              meta: {
                title: 'Practice',
                description: 'PraticeList',
                postType: 'post_pratices',
              },
            },
            {
              path: 'new',
              name: 'PraticeNew',
              component: NewPost,
              meta: {
                title: 'Create New Practice',
                description: 'PraticeNew',
                postType: 'post_pratices',
              },
            },
            {
              path: ':id',
              name: 'PraticeDetail',
              component: EditPost,
              meta: {
                title: 'Edit Practice',
                description: 'PraticeDetail',
                postType: 'post_pratices',
              },
            },
          ],
        },
        //=================================== Pratices ==============================//

        {
          path: 'categories',
          name: 'categoryList',
          component: CategoryList,
          meta: {
            title: 'Category',
            description: '',
          },
        },
        {
          path: 'categories/new',
          name: 'categoryNew',
          component: CategoryNew,
          meta: {
            title: 'Create New Category',
            description: '',
          },
        },
        {
          path: 'categories/:id',
          name: 'categoryDetail',
          component: CategoryDetail,
          meta: {
            title: 'Edit Category',
            description: '',
          },
        },

        {
          path: 'settings',
          name: 'setting',
          component: Setting,
          meta: {
            title: 'Setting',
            description: '',
          },
        },

        {
          path: '*',
          name: 'pageNotFound',
          component: PageNotFound,
          meta: {
            title: 'Page Not Found',
            description: '',
          },
        },
      ],
    },
  ],
})
