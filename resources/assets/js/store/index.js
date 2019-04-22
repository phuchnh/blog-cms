import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth'
import faq from './modules/faq'
import taxonomy from './modules/taxonomy'
import taxonomies from './modules/taxonomies'
import post from './modules/post'
import user from './modules/user'
import client from './modules/client'
import meta from './modules/meta'
import setting from './modules/setting'

Vue.use(Vuex)
export default new Vuex.Store({
  state: () => ({}),
  actions: {},
  mutations: {},
  modules: {
    auth,
    faq,
    taxonomy,
    taxonomies,
    post,
    user,
    client,
    meta,
    setting
  },
})
