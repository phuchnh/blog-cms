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
  getList ({ commit }, params) {
    if (_.keys(params).length === 0) {
      params = { ...state.queryParams }
    }
    params = {
      ...params,
    }
    return ApiService.get('/clients', params).then(res => {
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
  getItem ({ commit }, id) {
    return ApiService.get(`/clients/${ id }`).then(res => {
      commit('setItem', res.data.data)
    })
  },
  delete ({ commit }, id) {
    return ApiService.delete(`/clients/${ id }`).then(() => {
      commit('delete', id)
    })
  },
  update ({ commit, dispatch }, payload) {
    const input = _.omit(payload, ['meta'])
    if (_.isString(payload.meta.thumbnail) || !payload.meta.thumbnail) {
      return ApiService.put(`/clients/${ payload.id }`, input)
    } else {
      return Promise.all([
        ApiService.post('/assets', payload.meta.thumbnail),
        ApiService.put(`/clients/${ payload.id }`, input),
      ]).then((resp) => {
        const imgUrl = resp[0].data.data[0].uri
        const clientId = payload.id
        const metaData = {
          thumbnail: imgUrl,
        }
        return dispatch('meta/createMeta', { data: metaData, model: 'clients', model_id: clientId }, { root: true })
      })
    }
  },
  create ({ commit, dispatch }, payload) {
    const input = _.omit(payload, ['meta'])
    if (!payload.meta.thumbnail) {
      ApiService.post('/clients', input)
    } else {
      return Promise.all([
        ApiService.post('/assets', payload.meta.thumbnail),
        ApiService.post('/clients', input),
      ]).then((resp) => {
        const imgUrl = resp[0].data.data[0].uri
        const clientId = resp[1].data.data.id
        const metaData = {
          thumbnail: imgUrl,
        }
        return dispatch('meta/createMeta', { data: metaData, model: 'clients', model_id: clientId }, { root: true })
      })
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
