import Vue from 'vue'
import Router from 'vue-router'
import Admin from '@/view/Admin'
import Dashboard from '@/view/Dashboard'
import PageNotFound from '@/view/PageNotFound'
import PostContainer from '@/view/PostContainer'
import UserList from '@/view/UserList'
import UserDetail from '@/view/UserDetail'
import InThePressNew from '@/view/InThePressNew'
import InThePressList from '@/view/InThePressList'
import InThePressDetail from '@/view/InThePressDetail'
import InThePressTrashList from '@/view/InThePressTrashList'
import BlogList from '@/view/BlogList'
import BlogNew from '@/view/BlogNew'
import BlogDetail from '@/view/BlogDetail'
import ClientList from '@/view/ClientList'
import ClientDetail from '@/view/ClientDetail'
import ClientNew from '@/view/ClientNew'
import GuideList from '@/view/GuideList'
import GuideDetail from '@/view/GuideDetail'
import GuideNew from '@/view/GuideNew'
import EventList from '@/view/EventList'
import EventDetail from '@/view/EventDetail'
import EventNew from '@/view/EventNew'
import PracticeList from '@/view/PracticeList'
import PracticeDetail from '@/view/PracticeDetail'
import PracticeNew from '@/view/PracticeNew'
import FaqDetail from '@/view/FaqDetail'
import FaqNew from '@/view/FaqNew'
import Setting from '@/view/Setting'
import CategoryList from '@/view/CategoryList'
import CategoryNew from '@/view/CategoryNew'
import CategoryDetail from '@/view/CategoryDetail'
import PostList from '@/view/PostList'
import PostNew from '@/view/PostNew'
import PostDetail from '@/view/PostDetail'
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
                title: 'FaqList',
                description: '',
                postType: 'post_faq',
              },
            },
            {
              path: 'new',
              name: 'FaqNew',
              component: NewPost,
              meta: {
                title: 'FaqNew',
                description: 'Add new',
                postType: 'post_faq',
              },
            },
            {
              path: ':id',
              name: 'FaqDetail',
              component: EditPost,
              meta: {
                title: 'FaqDetail',
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
          path: 'posts',
          name: 'postList',
          component: PostList,
          meta: {
            title: 'PostList',
            description: '',
          },
        },
        {
          path: 'posts/new',
          name: 'postNew',
          component: PostNew,
          meta: {
            title: 'PostNew',
            description: '',
          },
        },
        {
          path: 'posts/:id',
          name: 'postDetail',
          component: PostDetail,
          meta: {
            title: 'PostDetail',
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
                title: 'InThePressList',
                description: 'InThePressList',
                postType: 'post_presses',
              },
            },
            {
              path: 'new',
              name: 'InThePressNew',
              component: NewPost,
              meta: {
                title: 'InThePressNew',
                description: 'InThePressNew',
                postType: 'post_presses',
              },
            },
            {
              path: ':id',
              name: 'InThePressDetail',
              component: EditPost,
              meta: {
                title: 'InThePressDetail',
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
                title: 'BlogList',
                description: 'BlogList',
                postType: 'post_blogs',
              },
            },
            {
              path: 'new',
              name: 'BlogNew',
              component: NewPost,
              meta: {
                title: 'BlogNew',
                description: 'BlogNew',
                postType: 'post_blogs',
              },
            },
            {
              path: ':id',
              name: 'BlogDetail',
              component: EditPost,
              meta: {
                title: 'BlogDetail',
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
                title: 'GuideList',
                description: 'GuideList',
                postType: 'post_guides',
              },
            },
            {
              path: 'new',
              name: 'GuideNew',
              component: NewPost,
              meta: {
                title: 'GuideNew',
                description: 'GuideNew',
                postType: 'post_guides',
              },
            },
            {
              path: ':id',
              name: 'GuideDetail',
              component: EditPost,
              meta: {
                title: 'GuideDetail',
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
                title: 'EventList',
                description: 'EventList',
                postType: 'post_events',
              },
            },
            {
              path: 'new',
              name: 'EventNew',
              component: NewPost,
              meta: {
                title: 'EventNew',
                description: 'EventNew',
                postType: 'post_events',
              },
            },
            {
              path: ':id',
              name: 'EventDetail',
              component: EditPost,
              meta: {
                title: 'EventDetail',
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
                title: 'PraticeList',
                description: 'PraticeList',
                postType: 'post_pratices',
              },
            },
            {
              path: 'new',
              name: 'PraticeNew',
              component: NewPost,
              meta: {
                title: 'PraticeNew',
                description: 'PraticeNew',
                postType: 'post_pratices',
              },
            },
            {
              path: ':id',
              name: 'PraticeDetail',
              component: EditPost,
              meta: {
                title: 'PraticeDetail',
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
            title: 'CategoryList',
            description: '',
          },
        },
        {
          path: 'categories/new',
          name: 'categoryNew',
          component: CategoryNew,
          meta: {
            title: 'CategoryNew',
            description: '',
          },
        },
        {
          path: 'categories/:id',
          name: 'categoryDetail',
          component: CategoryDetail,
          meta: {
            title: 'CategoryDetail',
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
            title: 'PageNotFound',
            description: '',
          },
        },
      ],
    },
  ],
})
