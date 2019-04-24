import { PostService } from '@/api'
import * as _ from 'lodash'

export default {
  namespaced: true,
  state: () => {
    return {
      postType: 'post',
      lists: [],
      total: 0,
      queryParams: {
        sort: 'updated_at',
        direction: 'desc',
        page: 1,
        perPage: 10,
        only: ['id', 'slug', 'title', 'description'].join(','),
      },
      loading: false,
      item: {
        translations: [],
        taxonomies: [],
        metas: {
          seo: [],
        },
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

    getLoading: (state) => {
      return state.loading
    },

    getPostType: (state) => {
      return state.postType
    },
  },

  mutations: {
    startLoading (state) {
      state.loading = true
    },

    endLoading (state) {
      state.loading = false
    },

    setItem (state, item) {
      state.item = { ...item }
    },

    setList (state, { lists, total, queryParams = {} }) {
      state.lists = [...lists]
      state.total = total
      state.queryParams = { ...queryParams }
    },

    deleteItemInList (state, { lists, total }) {
      state.lists = [...lists]
      state.total = total
    },

    setPostType: (state, postType) => {
      state.postType = postType
    },
  },

  actions: {

    setPostType: ({ state, commit }, postType) => {
      commit('setPostType', postType)
    },

    fetchList ({ state, commit }, params = {}) {
      commit('startLoading')

      if (_.keys(params).length === 0) {
        params = { ...state.queryParams }
      }

      params = {
        ...params,
        with: 'taxonomies',
      }

      return PostService
        .getPosts(state.postType, params)
        .then(resp => {
          const { params } = resp.config
          const { data, pagination } = resp.data

          commit('setList', {
            lists: data,
            total: pagination.total,
            queryParams: params,
          })

          commit('endLoading')
        })
        .catch(err => {
          console.log(err)
        })
    },
    fetchItem ({ commit }, id) {
      commit('startLoading')
      return PostService
        .getPost(id, { with: 'translations,taxonomies' })
        .then(resp => {
          const { data } = resp.data
          commit('setItem', data)
          commit('endLoading')
        })
    },

    createItem ({ commit }, payload) {
      commit('startLoading')
      return PostService
        .createPost(payload)
        .then(resp => {
          commit('endLoading')
          const { data } = resp.data
          return data
        })
    },

    updateItem ({ commit }, payload) {
      commit('startLoading')
      return PostService
        .updatePost(payload.id, payload)
        .then(() => {
          commit('endLoading')
          return payload
        })
    },

    deleteItem ({ state, commit, dispatch }, id) {
      commit('startLoading')
      return PostService
        .deletePost(id)
        .then(resp => {
          commit('endLoading')
          return resp
        })
    },
  },
}