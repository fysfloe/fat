import axios from '../../config/axios'

const name = 'user'

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
    update ({ dispatch }, user) {
      axios.patch(`${name}/${user.id}`, user).then(() => {
        dispatch('get', user.id)
      })
    },
    async get ({ commit }, handle) {
      commit('isLoading', true)

      const response = await axios.get(`${name}/${handle}`)

      commit('setCurrent', response.data.data)
      commit('isLoading', false)

      return response
    }
  }
}
