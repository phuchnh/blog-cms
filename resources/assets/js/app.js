require('./bootstrap')
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import Antd from 'ant-design-vue'
import ElementUI from 'element-ui';
import VeeValidate from 'vee-validate'
import * as filters from './util/filters'
import locale from 'element-ui/lib/locale/lang/en'


Vue.config.productionTip = false
Vue.use(Antd)
Vue.use(ElementUI, { locale });
Vue.use(VeeValidate, { locale: 'vi' })

// register global utility filters.
Object.keys(filters).forEach(key => {
  Vue.filter(key, filters[key])
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiredAuth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (!store.state.auth.isAuthenticated) {
      next({
        path: '/login',
        query: { redirect: to.fullPath },
      })
    } else {
      if (!store.state.auth.currentUser.name) {
        store.dispatch('auth/CHECK_AUTH').then(() => {
          if (_.includes(to.meta.permission, store.state.auth.currentUser.type)) {
            next()
          } else {
            next(false)
          }
        })
      } else if (_.includes(to.meta.permission, store.state.auth.currentUser.type)) {
        next()
      } else {
        next(false)
      }
    }
  } else {
    debugger
    next()
  }
})

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
