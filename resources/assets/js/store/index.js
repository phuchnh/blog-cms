import Vue from 'vue';
import Vuex from 'vuex';
import {AuthModule} from './modules';
import {FaqModule} from './modules';
import post from './modules/post.module';
import user from './modules/user.module';
import client from './modules/client.module';

Vue.use(Vuex);

export function createStore() {
    return new Vuex.Store({
        state: () => ({}),
        actions: {},
        mutations: {},
        modules: {
            auth: AuthModule,
            faq: FaqModule,
            post,
            user,
            client
        }
    });
}