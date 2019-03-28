import Vue from 'vue';
import App from './App.vue';
import { createRouter } from './router';

export function createApp() {

    // create router instance
    const router = createRouter();

    const app = new Vue({
        // inject router into root Vue instance
        router,
        // the root instance simply renders the App component.
        render: h => h(App)
    });
    return { app, router };
}

require('./bootstrap');

const { app } = createApp();
app.$mount('#app');
