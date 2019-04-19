import { ApiService } from '../../api'
import { Helper } from '../../util/helper'

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
  /**
   * update meta data
   * @param commit
   * @param payload
   * @returns {*}
   */
  async updateMeta ({ commit }, payload) {
    let inputMeta = payload.data ? Helper.filterInputMeta(payload.data, payload.post_id) : []

    return await ApiService.put(`/meta/${ payload.post_id }/post_meta`, inputMeta).then(res => {
      commit('setMeta', res.data.data)
    })
  },
  /**
   * create new meta data
   * @param commit
   * @param payload
   */
  createMeta ({ commit }, payload) {
    // filter input meta
    let inputMeta = payload.data ? Helper.filterInputMeta(payload.data, payload.post_id) : []

    return ApiService.post(`/posts/${ payload.post_id }/post_meta`, inputMeta).then((res) => {
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
