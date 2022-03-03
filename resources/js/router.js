import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
import Home from './pages/Home.vue'
import About from './pages/About.vue'


const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/About",
            name: "about",
            component: About
        }
    ]
});

export default router