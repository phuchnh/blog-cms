import { ApiService } from '../../api'
import * as _ from 'lodash'

export const namespaced = true
const initialState = {
  clients: [],
  client: {},
  paginator: {},
  queryParams: {
    sort: 'updated_at',
    direction: 'desc',
    page: 1,
    perPage: 10,
    only: ['id', 'name', 'meta'].join(','),
  },
}

export const state = { ...initialState }

const getters = {
  client: state => state.client,
  clients: state => state.clients,
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
    await ApiService.get('/clients', params).then(res => {
      const pagination = res.data.pagination
      const clients = res.data.data

      commit('setList', {
        clients: clients,
        queryParams: params,
      })
      commit('setPaginator', {
        total: pagination.total,
        pageSize: pagination.perPage,
      })
    })
  },
  async getItem ({ commit }, id) {
    await ApiService.get(`/clients/${ id }`).then(res => {
      commit('setItem', res.data.data)
    })
  },
  async delete ({ commit }, id) {
    await ApiService.delete(`/clients/${ id }`).then(() => {
      commit('delete', id)
    })
  },
  async update ({ commit, dispatch }, payload) {
    const input = _.omit(payload, ['meta'])
    await ApiService.put(`/clients/${ payload.id }`, input)

    // insert to meta table
    if (!_.isEmpty(payload.meta)) {
      await dispatch('meta/createMeta', { data: payload.meta, model: 'clients', model_id: payload.id }, { root: true })
    }
  },
  async create ({ commit, dispatch }, payload) {
    const input = _.omit(payload, ['meta'])
    const resp = await ApiService.post('/clients', input)

    const { data } = resp.data

    // insert to meta table
    if (!_.isEmpty(payload.meta)) {
      await dispatch('meta/createMeta', { data: payload.meta, model: 'clients', model_id: data.id }, { root: true })
    }
  },
  resetState ({ commit }) {
    commit('resetState')
  },
}

const mutations = {
  setList (state, { clients, queryParams = {} }) {
    state.clients = clients
    state.queryParams = { ...queryParams }
  },
  setItem (state, client) {
    state.client = client
  },
  delete (state, id) {
    state.clients = _.filter(state.clients, (item) => {
      return item.id !== id
    })
  },
  resetState (state) {
    state.client = {}
    state.clients = []
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
