import { ApiService } from '../../api'
import * as _ from 'lodash'

export const namespaced = true
const initialState = {
  users: [],
  user: {},
  paginator: {},
  queryParams: {
    sort: 'updated_at',
    direction: 'desc',
    page: 1,
    perPage: 10,
    only: ['id', 'name', 'type'].join(','),
  },
}

export const state = { ...initialState }

const getters = {
  user: state => state.user,
  users: state => state.users,
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
    await ApiService.get('/users', params).then(res => {
      const pagination = res.data.pagination
      const users = res.data.data

      commit('setList', {
        users: users,
        queryParams: params,
      })
      commit('setPaginator', {
        total: pagination.total,
        pageSize: pagination.perPage,
      })
    })
  },
  async getItem ({ commit }, id) {
    await ApiService.get(`/users/${ id }`).then(res => {
      commit('setItem', res.data.data)
    })
  },
  async delete ({ commit }, id) {
    await ApiService.delete(`users/${ id }`).then(() => {
      commit('delete', id)
    })
  },
  async update ({ commit, dispatch }, payload) {
    const input = _.omit(payload, ['meta'])
    await ApiService.put(`/users/${ payload.id }`, input)

    // insert to meta table
    await dispatch('meta/createMeta', { data: payload.meta, model: 'users', model_id: payload.id }, { root: true })
  },
  async create ({ commit, dispatch }, payload) {
    const input = _.omit(payload, ['meta'])
    const resp = await ApiService.post('/users', input)

    const { data } = resp.data

    // insert to meta table
    await dispatch('meta/createMeta', { data: payload.meta, model: 'users', model_id: data.id }, { root: true })

  },
  resetState ({ commit }) {
    commit('resetState')
  },
}

const mutations = {
  setList (state, { users, queryParams = {} }) {
    state.users = users
    state.queryParams = { ...queryParams }
  },
  setItem (state, user) {
    state.user = user
  },
  delete (state, id) {
    state.users = _.filter(state.users, (item) => {
      return item.id !== id
    })
  },
  resetState (state) {
    state.user = {}
    state.users = []
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
