import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './pages/Home.vue'
import Login from './pages/Login.vue'
import NotFound from './pages/errors/NotFound.vue'
import SystemError from './pages/errors/SystemError.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/500',
        component: SystemError
    },
    {
        path: "*",
        component: NotFound
    },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router
