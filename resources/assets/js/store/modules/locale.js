export default {
  namespaced: true,
  state: () => {
    return {
      locale: 'vi'
    }
  },

  getters: {
    getLocale: (state) => {
      return state.locale
    },
  },

  mutations: {
    setLocale (state, locale) {
      state.locale = locale
    },
  },

  actions: {
    setLocale ({ commit }, locale) {
      commit('setLocale', locale)
      commit('faq/setLocale', locale, { root: true })
    }
  },
}
