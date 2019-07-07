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
import Navigation from '@/view/Navigation'
import CategoryList from '@/view/CategoryList'
import CategoryNew from '@/view/CategoryNew'
import CategoryDetail from '@/view/CategoryDetail'
import PostContainer from '@/view/PostContainer'

import ListPost from './components/ListPost'
import EditPost from './components/EditPost'
import NewPost from './components/NewPost'

import PostSimpleList from './components/PostSimpleList'
import PostSimpleEdit from './components/PostSimpleEdit'
import PostSimpleNew from './components/PostSimpleNew'

import TaxonomyForm from './components/TaxonomyForm'
import SubscriberList from '@/view/SubscriberList'
import SubscriberDetail from '@/view/SubscriberDetail'

import SubscriptionList from '@/view/SubscriptionList'
import SubscriptionDetail from '@/view/SubscriptionDetail'

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
        //==================================================================
        {
          path: 'dashboard',
          name: 'dashboard',
          component: Dashboard,
          meta: {
            title: 'Dashboard',
            description: '',
            permission: ['admin', 'editor'],
          },
        },
        //==================================================================
        {
          path: 'taxonomy/:id',
          name: 'TaxonomyEdit',
          component: TaxonomyForm,
          meta: {
            title: 'Edit Taxonomy',
            description: '',
            permission: ['admin', 'editor'],
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
            permission: ['admin'],
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
                permission: ['admin'],
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
                permission: ['admin'],
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
                permission: ['admin'],
              },
            },
          ],
        },
        //================================ User ==================================
        {
          path: 'users',
          name: 'userList',
          component: UserList,
          meta: {
            title: 'User',
            description: '',
            permission: ['admin'],
          },
        },
        {
          path: 'users/new',
          name: 'userNew',
          component: UserNew,
          meta: {
            title: 'Create New User',
            description: '',
            permission: ['admin'],
          },
        },
        {
          path: 'users/:id',
          name: 'userDetail',
          component: UserDetail,
          meta: {
            title: 'Edit User',
            description: '',
            permission: ['admin', 'editor'],
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
            permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
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
            permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
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
            permission: ['admin'],
          },
        },
        {
          path: 'clients/new',
          name: 'clientNew',
          component: ClientNew,
          meta: {
            title: 'Create New Client',
            description: '',
            permission: ['admin'],
          },
        },
        {
          path: 'clients/:id',
          name: 'clientDetail',
          component: ClientDetail,
          meta: {
            title: 'Edit Client',
            description: '',
            permission: ['admin'],
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
            permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
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
            permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
              },
            },
          ],
        },
        //=================================== Events ==============================//

        //=================================== Programs ==============================//
        {
          path: 'programs',
          component: PostContainer,
          props: {
            postType: 'post_programs',
            redirectToNew: 'ProgramNew',
            redirectToDetail: 'ProgramDetail',
            redirectToList: 'ProgramList',
          },
          meta: {
            postType: 'post_programs',
            permission: ['admin', 'editor'],
          },
          children: [
            {
              path: '',
              name: 'ProgramList',
              component: ListPost,
              meta: {
                title: 'Program',
                description: 'ProgramList',
                postType: 'post_programs',
                permission: ['admin', 'editor'],
              },
            },
            {
              path: 'new',
              name: 'ProgramNew',
              component: NewPost,
              meta: {
                title: 'Create New Program',
                description: 'ProgramNew',
                postType: 'post_programs',
                permission: ['admin', 'editor'],
              },
            },
            {
              path: ':id',
              name: 'ProgramDetail',
              component: EditPost,
              meta: {
                title: 'Edit Program',
                description: 'ProgramDetail',
                postType: 'post_programs',
                permission: ['admin', 'editor'],
              },
            },
          ],
        },
        //=================================== Events ==============================//

        //=================================== Practices ==============================//
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
            permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
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
                permission: ['admin', 'editor'],
              },
            },
          ],
        },
        //=================================== Pratices ==============================//

        //=================================== Peoples ==============================//
        {
          path: 'people',
          component: PostContainer,
          props: {
            postType: 'post_people',
            redirectToNew: 'PeopleNew',
            redirectToDetail: 'PeopleDetail',
            redirectToList: 'PeopleList',
          },
          meta: {
            postType: 'post_people',
            permission: ['admin'],
          },
          children: [
            {
              path: '',
              name: 'PeopleList',
              component: PostSimpleList,
              meta: {
                title: 'People',
                description: 'PeopleList',
                postType: 'post_people',
                permission: ['admin'],
              },
            },
            {
              path: 'new',
              name: 'PeopleNew',
              component: PostSimpleNew,
              meta: {
                title: 'Create New People',
                description: 'PeopleNew',
                postType: 'post_people',
                permission: ['admin'],
              },
            },
            {
              path: ':id',
              name: 'PeopleDetail',
              component: PostSimpleEdit,
              meta: {
                title: 'Edit People',
                description: 'PeopleDetail',
                postType: 'post_people',
                permission: ['admin'],
              },
            },
          ],
        },
        //=================================== Peoples ==============================//

        //=================================== Testimonials ==============================//
        {
          path: 'testimonial',
          component: PostContainer,
          props: {
            postType: 'post_testimonial',
            redirectToNew: 'TestimonialNew',
            redirectToDetail: 'TestimonialDetail',
            redirectToList: 'TestimonialList',
          },
          meta: {
            postType: 'post_testimonial',
            permission: ['admin'],
          },
          children: [
            {
              path: '',
              name: 'TestimonialList',
              component: PostSimpleList,
              meta: {
                title: 'Testimonial',
                description: 'TestimonialList',
                postType: 'post_testimonial',
                permission: ['admin'],
              },
            },
            {
              path: 'new',
              name: 'TestimonialNew',
              component: PostSimpleNew,
              meta: {
                title: 'Create New Testimonial',
                description: 'TestimonialNew',
                postType: 'post_testimonial',
                permission: ['admin'],
              },
            },
            {
              path: ':id',
              name: 'TestimonialDetail',
              component: PostSimpleEdit,
              meta: {
                title: 'Edit Testimonial',
                description: 'TestimonialDetail',
                postType: 'post_testimonial',
                permission: ['admin'],
              },
            },
          ],
        },
        //=================================== Testimonials ==============================//

        //=================================== Subscriber ==============================//
        {
          path: 'mailchimps',
          name: 'SubscriberList',
          component: SubscriberList,
          meta: {
            title: 'Mailchimp',
            description: '',
            permission: ['admin'],
          },
        },
        {
          path: 'mailchimps/:email',
          name: 'SubscriberDetail',
          component: SubscriberDetail,
          meta: {
            title: 'View Mailchimp Account',
            description: '',
            permission: ['admin'],
          },
        },
        //=================================== Subscriber ==============================//

        //=================================== Subscription ==============================//
        {
          path: 'subscriptions',
          name: 'SubscriptionList',
          component: SubscriptionList,
          meta: {
            title: 'Subscription',
            description: '',
            permission: ['admin'],
          },
        },
        {
          path: 'subscriptions/:id',
          name: 'SubscriptionDetail',
          component: SubscriptionDetail,
          meta: {
            title: 'View Subscription',
            description: '',
            permission: ['admin'],
          },
        },
        //=================================== Subscription ==============================//

        {
          path: 'categories',
          name: 'categoryList',
          component: CategoryList,
          meta: {
            title: 'Category',
            description: '',
            permission: ['admin', 'editor'],
          },
        },
        {
          path: 'categories/new',
          name: 'categoryNew',
          component: CategoryNew,
          meta: {
            title: 'Create New Category',
            description: '',
            permission: ['admin', 'editor'],
          },
        },
        {
          path: 'categories/:id',
          name: 'categoryDetail',
          component: CategoryDetail,
          meta: {
            title: 'Edit Category',
            description: '',
            permission: ['admin', 'editor'],
          },
        },

        {
          path: 'navigation',
          name: 'navigation',
          component: Navigation,
          meta: {
            title: 'Navigation',
            description: '',
            permission: ['admin'],
          },
        },

        {
          path: 'settings',
          name: 'setting',
          component: Setting,
          meta: {
            title: 'Setting',
            description: '',
            permission: ['admin'],
          },
        },

        {
          path: '*',
          name: 'pageNotFound',
          component: PageNotFound,
          meta: {
            title: 'Page Not Found',
            description: '',
            permission: ['admin', 'editor'],
          },
        },
      ],
    },
  ],
})
