import { ApiService } from '../../api'
import * as _ from 'lodash'
import axios from 'axios'

export const namespaced = true
const initialState = {
  list: [],
  item: {},
  paginator: {},
  queryParams: {
    sort: 'updated_at',
    direction: 'desc',
    page: 1,
    perPage: 10,
  },
}

export const state = { ...initialState }

const getters = {
  list: state => state.list,
  item: state => state.item,
  pagination: state => state.paginator,
  getQueryParams: state => state.queryParams,
}

const actions = {
  async getList ({ commit }, params) {
    if (_.keys(params).length === 0) {
      params = { ...state.queryParams }
    }
    params = {
      ...params,
    }
    await ApiService.get('/subscriptions', params).then(res => {
      const pagination = res.data.pagination
      const list = res.data.data

      commit('setList', {
        list: list,
        queryParams: params,
      })
      commit('setPaginator', {
        total: pagination.total,
        pageSize: pagination.perPage,
      })
    })
  },
  async getItem ({ commit }, id) {
    await ApiService.get(`/subscriptions/${ id }`).then(res => {
      commit('setItem', res.data.data)
    })
  },
  resetState ({ commit }) {
    commit('resetState')
  },
}

const mutations = {
  setList (state, { list, queryParams = {} }) {
    state.list = list
    state.queryParams = { ...queryParams }
  },
  setItem (state, item) {
    state.item = item
  },
  resetState (state) {
    state.list = []
    state.item = {}
  },
  setPaginator: (state, paginator) => {
    state.paginator = { ...paginator }
  },
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations,
}
