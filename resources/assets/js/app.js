import Vue from 'vue';
import App from './App.vue';
import { createRouter } from './router';
import { createStore } from './store';

export function createApp() {

    // create store instance
    const store = createStore();

    // create router instance
    const router = createRouter();

    router.beforeEach((to, from, next) => {
        if (to.matched.some(record => record.meta.requiredAuth)) {
            // this route requires auth, check if logged in
            // if not, redirect to login page.
            if (!store.state.auth.isAuthenticated) {
                next({
                    path: '/login',
                    query: { redirect: to.fullPath }
                });
            } else {
                store.dispatch('auth/CHECK_AUTH').then(() => next());
            }
        } else {
            next();
        }
    });

    const app = new Vue({
        // inject store into root Vue instance
        store,
        // inject router into root Vue instance
        router,
        // the root instance simply renders the App component.
        render: h => h(App)
    });
    return { app, router, store };
}

require('./bootstrap');

const { app } = createApp();
app.$mount('#app');
