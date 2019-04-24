export default {
  namespaced: true,
  state: () => ({
    redirectToNew: '',
    redirectToDetail: '',
    redirectToList: '',
  }),
  getters: {
    redirectToNew: (state) => state.redirectToNew,
    redirectToDetail: (state) => state.redirectToDetail,
    redirectToList: (state) => state.redirectToList,
  },
  mutations: {
    setNew: (state, route) => state.redirectToNew = route,
    setDetail: (state, route) => state.redirectToDetail = route,
    setList: (state, route) => state.redirectToList = route,
  },

  actions: {
    setNew: ({ commit }, route) => commit('setNew', route),
    setDetail: ({ commit }, route) => commit('setDetail', route),
    setList: ({ commit }, route) => commit('setList', route),
  },
}