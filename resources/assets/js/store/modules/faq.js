import { FaqService } from '@/api'

export default {
  namespaced: true,
  state: () => {
    return {
      lists: [],
      total: 0,
      queryParams: {
        sort: 'updated_at',
        direction: 'desc',
        page: 1,
        perPage: 10,
        only: ['id', 'slug', 'title', 'description'].join(','),
      },
      loadingList: true,
      loadingItem: true,
      item: {
        translations: [],
      },
    }
  },

  getters: {
    getItem: (state) => {
      return state.item
    },

    getLists: (state) => {
      return state.lists
    },

    getTotal: (state) => {
      return state.total
    },

    getQueryParams: (state) => {
      return state.queryParams
    },

    onFetchList: (state) => {
      return state.loadingList
    },

    onFetchItem: (state) => {
      return state.loadingItem
    },
  },

  mutations: {
    startFetchList (state) {
      state.loadingList = true
    },

    endFetchList (state) {
      state.loadingList = false
    },

    startFetchItem (state) {
      state.loadingItem = true
    },

    endFetchItem (state) {
      state.loadingItem = false
    },

    setItem (state, item) {
      state.item = { ...item }
    },

    setList (state, { lists, total, queryParams = {} }) {
      state.lists = [...lists]
      state.total = total
      state.queryParams = { ...queryParams }
    },
  },

  actions: {
    fetchList ({ state, commit }, params = {}) {
      commit('startFetchList')
      if (_.keys(params).length === 0) {
        params = { ...state.queryParams }
      }
      return FaqService
        .getAll(params)
        .then(resp => {
          const { params } = resp.config
          const { data, pagination } = resp.data

          commit('setList', {
            lists: data,
            total: pagination.total,
            queryParams: params,
          })

          commit('endFetchList')
        })
        .catch(err => {
          console.log(err)
        })
    },
    fetchItem ({ commit }, id) {
      commit('startFetchItem')
      return FaqService
        .getById(id, { with: 'translations' })
        .then(resp => {
          const { data } = resp.data
          commit('setItem', data)
          commit('endFetchItem')
        })
    },

    createItem ({ commit }, payload) {
      commit('startFetchItem')
      return FaqService
        .create(payload)
        .then(resp => {
          commit('endFetchItem')
          const { data } = resp.data
          return data
        })
    },

    updateItem ({ commit }, payload) {
      commit('startFetchItem')
      return FaqService
        .update(payload.id, payload)
        .then((resp) => {
          commit('endFetchItem')
          return resp
        })
    },
  },
}