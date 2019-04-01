import Vue from 'vue';
import Vuex from 'vuex';

import auth from './modules/auth.module';
import post from './modules/post.module';
import user from './modules/user.module';
import client from './modules/client.module';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    auth,
    post,
    user,
    client
  }
});
