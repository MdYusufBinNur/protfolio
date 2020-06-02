/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/* VUE */
window.Vue = require('vue');

/* Vue Router */
import VueRouter from 'vue-router'
Vue.use(VueRouter);

/* V-Form */
import { Form, HasError, AlertError } from 'vform'
window.Form = Form; // This One Is Global Declaration So That You Can Use it anywhere with the Form
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);


/*Vue Progressbar*/
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(62,207,255)',
    failedColor: 'red',
    height: '2px'
});

/* Sweet alert */
import Swal from 'sweetalert2'
window.swal = Swal; // This One Is Global Declaration So That You Can Use it anywhere with the sawl

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = Toast; // This One Is Global Declaration So That You Can Use it anywhere with the toast

/* Global Listener For Any Changes */
window.Fire = new Vue();



/* Route Paths */
const routes = [
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/blog_category', component: require('./components/Blogs/BlogCategory').default },
    { path: '/project_category', component: require('./components/Projects/ProjectCategory').default },
    { path: '/projects', component: require('./components/Projects/Projects').default },
    { path: '/abouts', component: require('./components/About/About').default },
    { path: '/job_details', component: require('./components/Job Details/JobDetails').default },
    { path: '/contacts', component: require('./components/Contact/contact').default },
    { path: '/', component: require('./components/Web/web').default },
    { path: '/portfolio', component: require('./components/Web/portfolio').default },
    { path: '/web_about', component: require('./components/Web/about').default },
    { path: '/details',  component: require('./components/Web/details').default },
];

const router = new VueRouter({
    mode: 'history',
    routes
});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});
