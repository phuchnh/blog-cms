import { UserService} from '../../api/user.service'
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
    await UserService.getList(params).then(res => {
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
