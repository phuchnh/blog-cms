import Vue from 'vue';
import Vuex from 'vuex';
import { AuthModule } from './modules';

Vue.use(Vuex);

export function createStore() {
    return new Vuex.Store({
        state: () => ({}),
        actions: {},
        mutations: {},
        modules: {
            auth: AuthModule
        }
    });
}