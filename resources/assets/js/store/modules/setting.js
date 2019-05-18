import { ApiService } from '../../api'
import { Helper } from '../../util/helper'

export const namespaced = true

const initialState = {
  list: {},
}

export const state = { ...initialState }

const getters = {
  list: state => state.list,
}

const actions = {
  async fetchList ({ commit }, params) {
    await ApiService.get('/options', params).then(res => {
      commit('setList', res.data.data)
    })
  },
  async storeSetting ({ dispatch, commit }, payload) {
    const input = Helper.filterInputSiteOption(payload)
    await ApiService.post(`/options`, input)
  },
  resetState ({commit}) {
    commit('resetState')
  }
}

const mutations = {
  setList (state, settings) {
    state.list = settings
  },
  resetState (state) {
    state.list = {}
  }
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations,
}
