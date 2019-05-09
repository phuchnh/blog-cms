import { ApiService } from '../../api'

export default {
  namespaced: true,
  state: () => {
    return {
      summary: {}
    }
  },

  getters: {
    getSummary: (state) => {
      return state.summary
    },
  },

  mutations: {
    setSummary (state, summary) {
      state.summary = { ...summary }
    },
  },

  actions: {
    async getSummary ({ commit }) {
      await ApiService.get('/summary').then((res) => {
        commit('setSummary', res.data.data)
      })
    },
  },
}
