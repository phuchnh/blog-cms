import { ApiService } from '@/api'

export default {
  namespaced: true,

  state: () => {
    return {
      postId: null,
      postMeta: null,
    }
  },

  getters: {
    getPostMeta: state => {
      return state.postMeta
    },
  },

  mutations: {
    setPostId (state, postId) {
      state.postId = postId
    },

    setPostMeta (state, postMeta) {
      state.postMeta = { ...postMeta }
    },
  },

  actions: {
    fetchPostMeta ({ commit }, postId) {
      commit('setPostId', postId)
      return ApiService
        .get(`/posts/${ postId }/post_metas`)
        .then(resp => {
          const { data } = resp.data
          const { postMeta } = data
          commit('setPostMeta', postMeta)
          return resp
        })
    },

    createPostMeta ({ commit }, { postId, metas }) {
      return ApiService
        .post(`/posts/${ postId }/post_metas`, {
          metas: metas,
        })
    },
  },
}