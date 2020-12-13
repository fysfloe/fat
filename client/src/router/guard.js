import store from '../store/index'

export default (to, from, next) => {
  if (to.meta.guarded !== false && to.name !== 'Login' && !store.getters.isLoggedIn) next({ name: 'Login' })
  else next()
}
