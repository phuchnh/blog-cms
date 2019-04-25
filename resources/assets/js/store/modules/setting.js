import { ApiService } from '../../api'
import { Helper } from '../../util/helper'

export const namespaced = true

const initialState = {
  settings: {},
}

export const state = { ...initialState }

const getters = {
  settings: state => state.settings,
}

const actions = {
  fetchList ({ commit }, params) {
    return ApiService.get('/options', params).then(res => {
      commit('setSetting', res.data.data)
    })
  },
  storeSetting ({ dispatch, commit }, payload) {
    const input = Helper.filterInputSiteOption(payload)
    return ApiService.post(`/options`, input)
  },
  resetState ({ commit }) {
    commit('resetState')
  },
}

const mutations = {
  setSetting (state, settings) {
    state.settings = settings
  },
  resetState (state) {
    state.settings = {}
  },
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations,
}
