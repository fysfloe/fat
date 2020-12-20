import Vue from 'vue'
import Vuex from 'vuex'
import axios from '../config/axios'
import game from '../modules/game/store'
import venue from '../modules/venue/store'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    user: null,
    isLoggedIn: false,
    alertBar: {
      type: null,
      show: false,
      text: ''
    },
    countries: {
      // TODO
      'at': 'Austria'
    }
  },
  actions: {
    login ({ commit }, credentials) {
      return axios.post('login', credentials)
        .then(response => {
          commit('setUser', response.data.user)
          localStorage.setItem('token', response.data.token)
        })
    },
    register ({ commit }, user) {
      return axios.post('register', user)
        .then(response => {
          commit('setUser', response.data.user)
          localStorage.setItem('token', response.data.token)
        })
    },
    logout ({ commit }) {
      commit('setUser', null)
      localStorage.removeItem('token')
      localStorage.removeItem('user')
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
      state.user = user
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
      return state.user !== null
    },
    categoryOptions: state => {
      return state.categories.items.map(category => {
        return {
          value: category._id,
          name: category.name
        }
      })
    }
  },
  modules: {
    game,
    venue
  }
})
