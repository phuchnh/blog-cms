require('./bootstrap')
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import Antd from 'ant-design-vue'
import VeeValidate from 'vee-validate'

Vue.config.productionTip = false
Vue.use(Antd)
Vue.use(VeeValidate, { locale: 'vi' })

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
        store.dispatch('auth/CHECK_AUTH').then(() => next())
      }
      next()
    }
  } else {
    next()
  }
})

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
