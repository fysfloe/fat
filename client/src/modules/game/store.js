import axios from '../../config/axios'

const name = 'football_game'

export default {
  namespaced: true,
  state: {
    items: [],
    current: null,
    isLoading: true
  },
  mutations: {
    setItems (state, items) {
      state.items = items
    },
    setCurrent (state, current) {
      state.current = current
    },
    isLoading (state, isLoading) {
      state.isLoading = isLoading
    }
  },
  actions: {
    async fetch ({ commit }) {
      commit('isLoading', true)

      const response = await axios.get(name)

      commit('setItems', response.data.data)
      commit('isLoading', false)
    },
    async create ({ dispatch }, game) {
      const response = await axios.post(name, game)

      dispatch('fetch')

      return response.data.data
    },
    update ({ dispatch }, game) {
      axios.patch(`${name}/${game.id}`, game).then(() => {
        dispatch('fetch')
      })
    },
    async get ({ commit }, slug) {
      commit('isLoading', true)

      const response = await axios.get(`${name}/${slug}`)

      commit('setCurrent', response.data.data)

      commit('isLoading', false)

      return response
    },
    async delete ({ dispatch }, id) {
      await axios.delete(`${name}/${id}`)

      dispatch('fetch')
    },
    async invite ({ dispatch, state }, email) {
      await axios.post(`${name}/invite`, { email: email }, {
        params: { gameId: state.current.id }
      })

      dispatch('fetch')
    }
  }
}
