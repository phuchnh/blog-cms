import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const Foo = { template: '<div>Foo</div>' };
const Foz = { template: '<div>Foz</div>' };
const Bar = { template: '<div>Bar</div>' };
const PageNotFound = { template: '<div>PageNotFound</div>' };

export function createRouter() {
    return new Router({
        mode: 'history',
        routes: [
            {
                path: 'admin',
                name: 'admin',
                children: [
                    { path: 'foz', name: 'foz', component: Foz },
                    { path: 'foo', name: 'foo', component: Foo },
                    { path: 'bar', name: 'bar', component: Bar },
                    { path: '*', name: 'pageNotFound', component: PageNotFound }
                ]
            }
        ]
    });
}