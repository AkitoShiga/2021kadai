import Vue from 'vue'
import VueRouter, { RouteConfig } from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Store from '@/store/index.ts'

Vue.use(VueRouter)

const routes: Array<RouteConfig> = [
  {
    name: 'Login',
    path: '/login',
    component: Login
  },
  {
    path: '/',
    name: 'Home',
    component: Home,
    meta: { requiresAuth: true }
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})
router.beforeEach(
  (to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)
       && !Store.state.userToken
    ) {
        next(
          {
            path: '/login',
            query: { redirect: to.fullPath }
          }
        );
      } else {
        next();
      }
  }
);

export default router
