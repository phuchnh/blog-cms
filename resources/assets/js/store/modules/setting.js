import { ApiService } from '../../api'

export const namespaced = true

const initialState = {
  settings: {},
  saved: false,
}

export const state = { ...initialState }

const getters = {
  settings: state => state.settings,
  saved: state => state.saved,
}

const actions = {
  fetchList ({ commit }, params) {
    return ApiService.get('/options', params).then(res => {
      commit('setSetting', res.data.data)
    })
  },
  updateSetting ({ commit }, payload) {
    return ApiService.post(`/options`, payload)
  },
  resetState ({ commit }) {
    commit('resetState')
  },
  savedSetting ({ commit }, payload) {
    commit('savedSetting', payload)
  },
}

const mutations = {
  setSetting (state, settings) {
    state.settings = settings
  },
  resetState (state) {
    state.settings = {}
    state.saved = false
  },
  savedSetting (state, saved) {
    state.saved = saved
  }
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations,
}
