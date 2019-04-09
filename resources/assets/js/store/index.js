import Vue from 'vue'
import Vuex from 'vuex'
import { AuthModule } from './modules'
import { FaqModule } from './modules'
import post from './modules/post'
import user from './modules/user'
import client from './modules/client'
import meta from './modules/meta'

Vue.use(Vuex)
export default new Vuex.Store({
  state: () => ({}),
  actions: {},
  mutations: {},
  modules: {
    auth: AuthModule,
    faq: FaqModule,
    post,
    user,
    client,
    meta
  },
})
