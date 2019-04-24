import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth'
import faq from './modules/faq'
import taxonomy from './modules/taxonomy'
import taxonomies from './modules/taxonomies'
import post from './modules/post'
import postMeta from './modules/postMeta'
import user from './modules/user'
import client from './modules/client'
import meta from './modules/meta'
import route from './modules/route'
import setting from './modules/setting'

Vue.use(Vuex)
export default new Vuex.Store({
  state: () => ({}),
  actions: {},
  mutations: {},
  modules: {
    auth,
    faq,
    route,
    taxonomy,
    taxonomies,
    post,
    postMeta,
    user,
    client,
    meta,
    setting
  },
})
