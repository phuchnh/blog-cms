import { UserService} from '../../api/user.service'
import * as _ from 'lodash'
import Vue from 'vue'

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
    await UserService.getList(params).then(res => {
      let pagination = res.data.pagination
      let users = res.data.data

      if (params.limit) {
        pagination.total = params.limit
        users = _.take(users, params.limit)
      }

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
    await UserService.getItem(id).then(res => {
      commit('setItem', res.data.data)
    })
  },
  async delete ({ commit }, id) {
    await UserService.delete(id).then(() => {
      commit('delete', id)
    })
  },
  async update ({ commit, dispatch }, payload) {
    const input = _.omit(payload, ['meta'])
    await UserService.update(payload.id, input)

    // insert to meta table
    if (!_.isEmpty(payload.meta)) {
      await dispatch('meta/createMeta', { data: payload.meta, model: 'users', model_id: payload.id }, { root: true })
    }
  },
  async create ({ commit, dispatch }, payload) {
    const input = _.omit(payload, ['meta'])
    const resp = await UserService.create(input)

    const { data } = resp.data

    // insert to meta table
    if (!_.isEmpty(payload.meta)) {
      await dispatch('meta/createMeta', { data: payload.meta, model: 'users', model_id: data.id }, { root: true })
    }

  },
  resetState ({ commit }) {
    commit('resetState')
  },
  setQueryParams ({commit}, params) {
    commit('setQueryParams', params)
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
    for (let f in state) {
      Vue.set(state, f, initialState[f])
    }
  },
  setPaginator: (state, paginator) => {
    state.paginator = { ...paginator }
  },
  setQueryParams (state, params) {
    state.queryParams = {...params}
  },
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations,
}
