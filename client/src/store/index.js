import Vue from 'vue'
import Vuex from 'vuex'
import axios from '../config/axios'
import game from '../modules/game/store'
import venue from '../modules/venue/store'
import user from '../modules/user/store'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    currentUser: null,
    isLoggedIn: false,
    alertBar: {
      type: null,
      show: false,
      text: ''
    }
  },
  actions: {
    login ({ dispatch }, credentials) {
      return axios.post('auth/login_check', credentials)
        .then(response => {
          localStorage.setItem('token', response.data.token)
          dispatch('getCurrentUser')
        })
    },
    getCurrentUser ({ commit }) {
      return axios.get('auth/current_user')
          .then(response => {
            commit('setUser', response.data.data)
          })
    },
    register ({ commit }, user) {
      return axios.post('auth/register', user)
        .then(response => {
          commit('setUser', response.data.data)
          localStorage.setItem('token', response.data.data.auth_token)
        })
    },
    logout ({ commit }) {
      return axios.post('auth/logout')
          .then(() => {
            commit('setUser', null)
            localStorage.removeItem('token')
            localStorage.removeItem('user')
          })
    },
    updateProfile ({ commit }, user) {
      return axios.post('users/update-profile', user)
        .then(response => {
          commit('setUser', response.data)
        })
    },
    changePassword (credentials) {
      return axios.post('users/change-password', credentials)
    },
    getCountries ({ commit }) {
      return axios.get('country')
          .then(response => {
            commit('setCountries', response.data.data)
          })
    }
  },
  mutations: {
    setUser (state, user) {
      state.currentUser = user
      localStorage.setItem('user', JSON.stringify(user))
    },
    showAlertBar (state, config) {
      state.alertBar.show = true
      state.alertBar.text = config.text
      state.alertBar.type = config.type
    },
    hideAlertBar (state) {
      state.alertBar = {
        type: null,
        show: false,
        text: ''
      }
    },
    setCountries (state, countries) {
      state.countries = countries
    }
  },
  getters: {
    isLoggedIn: state => {
      return state.currentUser !== null
    }
  },
  modules: {
    game,
    venue,
    user
  }
})
