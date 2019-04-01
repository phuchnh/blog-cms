import Vue from 'vue';
import Vuex from 'vuex';
import { PostModule } from './modules';
import { ClientModule } from './modules';
import { UserModule } from './modules';
import { AuthModule } from './modules';
import { FaqModule } from './modules';

Vue.use(Vuex);

export function createStore() {
    return new Vuex.Store({
        state: () => ({}),
        actions: {},
        mutations: {},
        modules: {
            auth: AuthModule,
            faq: FaqModule,
            post: PostModule,
            client: ClientModule,
            user: UserModule
        }
    });
}

