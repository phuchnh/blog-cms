import Vue from 'vue';
import App from './App.vue';
import { createRouter } from './router';
import Antd from 'ant-design-vue';
import store from './store';
import { ApiService } from './api';
import CKEditor from '@ckeditor/ckeditor5-vue';
import VeeValidate from 'vee-validate';
import _ from 'lodash';
Vue.prototype._ = _;

Vue.config.productionTip = false;
Vue.use(Antd);
Vue.use(CKEditor);
Vue.use(VeeValidate, { locale: 'vi'});
ApiService.init();

export function createApp() {

    // create router instance
    const router = createRouter();

    const app = new Vue({
        // inject router into root Vue instance
        router,
        store,
        // the root instance simply renders the App component.
        render: h => h(App)
    });
    return { app, router };
}

require('./bootstrap');

const { app } = createApp();
app.$mount('#app');
