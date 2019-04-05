import Vue from 'vue'
import Vuex from 'vuex'
import { AuthModule } from './modules'
import { FaqModule } from './modules'
import post from './modules/post.module'
import user from './modules/user.module'
import client from './modules/client.module'
import meta from './modules/meta.module'

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
