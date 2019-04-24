import { ApiService } from '@/api'

export default {
  namespaced: true,

  state: () => {
    return {
      postId: null,
      metas: null,
    }
  },

  getters: {
    getPostMeta: state => {
      return state.metas
    },
  },

  mutations: {
    setPostId (state, postId) {
      state.postId = postId
    },

    setPostMeta (state, metas) {
      state.metas = { ...metas }
    },
  },

  actions: {
    fetchPostMeta ({ commit }, postId) {
      commit('setPostId', postId)
      return ApiService
        .get(`/posts/${ postId }/metas`)
        .then(resp => {
          const { data } = resp.data
          const { metas } = data
          commit('setPostMeta', metas)
          return resp
        })
    },

    updateOrCreateMeta ({ commit }, { postId, metas }) {
      return ApiService
        .post(`/posts/${ postId }/metas`, {
          metas: metas,
        })
    },
  },
}