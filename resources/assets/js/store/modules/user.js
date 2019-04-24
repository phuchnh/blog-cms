import { ApiService } from '../../api'
import * as _ from 'lodash'

export const namespaced = true
const initialState = {
  users: [],
  user: {},
  saved: false,
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
  saved: state => state.saved,
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
    return ApiService.get('/users', params).then(res => {
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
  getItem ({ commit }, id) {
    return ApiService.get(`/users/${ id }`).then(res => {
      commit('setItem', res.data.data)
    })
  },
  delete ({ commit }, id) {
    return ApiService.delete(`users/${ id }`).then(() => {
      commit('delete', id)
    })
  },
  update ({ commit, dispatch }, payload) {
    const input = _.omit(payload, ['meta'])
    return Promise.all([
      ApiService.post('/assets', payload.meta.avatar),
      ApiService.put(`/users/${ payload.id }`, input),
    ]).then((resp) => {
      const imgUrl = resp[0].data.data[0].uri
      const userId = payload.id
      const metaData = {
        avatar: imgUrl,
      }
      return dispatch('meta/createMeta', { data: metaData, model: 'users', model_id: userId }, { root: true })
    })
  },
  create ({ commit, dispatch }, payload) {
    const input = _.omit(payload, ['meta'])
    return Promise.all([
      ApiService.post('/assets', payload.meta.avatar),
      ApiService.post('/users', input),
    ]).then((resp) => {
      const imgUrl = resp[0].data.data[0].uri
      const userId = resp[1].data.data.id
      const metaData = {
        avatar: imgUrl,
      }
      return dispatch('meta/createMeta', { data: metaData, model: 'users', model_id: userId }, { root: true })
    })
  },
  resetState ({ commit }) {
    commit('resetState')
  },
  saved ({ commit }, payload) {
    commit('saved', payload)
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
    state.saved = false
  },
  saved (state, saved) {
    state.saved = saved
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
