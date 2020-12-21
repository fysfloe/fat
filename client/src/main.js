import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import i18n from './i18n'
import VueI18n from 'vue-i18n'
import VueScrollTo from 'vue-scrollto'
import VueObserveVisibility from 'vue-observe-visibility'

Vue.config.productionTip = false

new Vue({
  router,
  store,
  i18n,
  render: h => h(App),
}).$mount('#app')

Vue.use(VueI18n)
Vue.use(require('vue-moment'));
Vue.use(VueScrollTo)
Vue.use(VueObserveVisibility)

require('flatpickr/dist/flatpickr.css')
require('@/assets/scss/main.scss')
