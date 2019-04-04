import { ApiService } from '../../api'

export const namespaced = true

const initialState = {
  meta: {},
  saved: false,
}

export const state = { ...initialState }

const getters = {
  meta: state => state.meta,
  saved: state => state.saved,
}

const actions = {
  getMeta ({ commit }, id) {
    return ApiService.get(`/meta/${ id }`).then(res => {
      commit('setMeta', res.data.data)
    })
  },
  deleteMeta ({ commit }, id) {
    return ApiService.delete(`/meta/${ id }`).then(() => {
      commit('deleteMeta', id)
    })
  },
  updateMeta ({ commit }, payload) {
    return ApiService.put(`/meta/${ payload.id }`, payload)
  },
  createMeta ({ commit }, payload) {
    console.log(payload)
    ApiService.post(`/posts/${payload.post_id}/post_meta`, payload.data).then((res) => {
      console.log(res)
      commit('setMeta', res.data.data)
    })
  },
  resetState ({ commit }) {
    commit('resetState')
  },
  savedMeta ({ commit }, payload) {
    commit('savedMeta', payload)
  },
}

const mutations = {
  setMeta (state, client) {
    state.client = client
  },
  deleteMeta (state, id) {
    state.client = _.filter(state.client, (item) => {
      return item.id !== id
    })
  },
  resetState (state) {
    state.client = {}
    state.saved = false
  },
  savedMeta (state, saved) {
    state.saved = saved
  },
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations,
}
