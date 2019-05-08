import { PostService } from '@/api'
import * as _ from 'lodash'
import Vue from 'vue'

const initialState = {
  postType: 'post',
  lists: [],
  total: 0,
  queryParams: {
    sort: 'updated_at',
    direction: 'desc',
    page: 1,
    perPage: 10,
    only: ['id', 'slug', 'title', 'description', 'publish'].join(','),
    locale: 'vi'
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

export default {
  namespaced: true,
  state: () => {
    return {...initialState}
  },

  getters: {
    getItem: (state) => {
      return state.item
    },

    getLists: (state) => {
      return state.lists
    },

    getListByType: (state) => (type) => {
      return state[type]
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

    setListByType (state, { type, lists }) {
      Vue.set(state, type, lists)
    },

    deleteItemInList (state, { lists, total }) {
      state.lists = [...lists]
      state.total = total
    },

    setPostType: (state, postType) => {
      state.postType = postType
    },

    setLocale (state, locale) {
      state.queryParams = {...state.queryParams, locale: locale}
    },

    setQueryParams (state, params) {
      state.queryParams = {...params}
    },

    resetState (state) {
      for (let f in state) {
        Vue.set(state, f, initialState[f])
      }
    }
  },

  actions: {

    setPostType: ({ state, commit }, postType) => {
      commit('setPostType', postType)
    },

    setQueryParams ({commit}, params) {
      commit('setQueryParams', params)
    },

    fetchListByType ({ state, commit }, params = {}) {
      return PostService
      .getPosts(params.type)
       .then(resp => {
        const { data } = resp.data

        commit('setListByType', {
          type: params.type,
          lists: data,
        })
      })
       .catch(err => {
        console.log(err)
      })
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
          let { data, pagination } = resp.data

          // Limit data
          if (params.limit) {
            data = _.take(data, params.limit)
            pagination.total = params.limit
          }

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

    createItem ({ state, commit }, payload) {
      commit('startLoading')
      return PostService
        .createPost({
          ...payload,
          type: state.postType,
        })
        .then(resp => {
          commit('endLoading')
          const { data } = resp.data
          return data
        })
    },

    updateItem ({ state, commit }, payload) {
      commit('startLoading')
      return PostService
        .updatePost(payload.id, {
          ...payload,
          type: state.postType,
        })
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

    resetState ({ commit }) {
      commit('resetState')
    },
  },
}
