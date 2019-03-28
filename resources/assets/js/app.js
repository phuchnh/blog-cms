require('./bootstrap');

const Vue = require('vue');
import App from './components/App';

export function createApp() {
    const app = new Vue({
        // the root instance simply renders the App component.
        render: h => h(App)
    });
    return { app };
}

const { app } = createApp();

app.$mount('#app');
