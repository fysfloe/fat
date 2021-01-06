import Vue from 'vue'
import VueRouter from 'vue-router'
import guard from './guard'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import(/* webpackChunkName: "home" */ '../components/main/Home.vue'),
    meta: { guarded: false }
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import(/* webpackChunkName: "login" */ '../components/auth/Login.vue'),
    meta: { guarded: false }
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import(/* webpackChunkName: "register" */ '../components/auth/Register.vue'),
    meta: { guarded: false }
  },
  {
    path: '/find-game',
    name: 'FindGame',
    component: () => import(/* webpackChunkName: "findGame" */ '../components/game/FindGame.vue'),
    meta: { guarded: false }
  },
  {
    path: '/game/create',
    name: 'CreateGame',
    component: () => import(/* webpackChunkName: "createGame" */ '../components/game/CreateGame.vue'),
    meta: { guarded: true }
  },
  {
    path: '/game/:id',
    name: 'Game',
    component: () => import(/* webpackChunkName: "game" */ '../components/game/Game.vue'),
    meta: { guarded: false }
  },
  {
    path: '/profile/:id?',
    name: 'Profile',
    component: () => import(/* webpackChunkName: "profile" */ '../components/profile/Profile.vue'),
    meta: { guarded: false }
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach(guard)

export default router
