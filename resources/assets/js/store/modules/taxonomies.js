import Vue from 'vue'
import { TaxonomyService } from '@/api'

export default {
  namespaced: true,

  state: () => {
    return {
      loading: false,
      item: {},
    }
  },

  getters: {
    getListByType: (state) => (type) => {
      return state[type]
    },

    getItem: (state) => {
      return state.item
    },

    getLoading: (state) => {
      return state.loading
    },
  },

  mutations: {
    addItemToList (state, { type, item }) {
      let list = state[type] || []
      list.push(item)
      Vue.set(state, type, list)
    },

    setListByType (state, { type, lists }) {
      Vue.set(state, type, lists)
    },

    setItem (state, item) {
      Vue.set(state, 'item', item)
    },

    beforeFetching (state) {
      state.loading = true
    },

    afterFetching (state) {
      state.loading = false
    },
  },

  actions: {
    updatePostTaxonomy ({ commit }, { postId, taxonomies }) {
      return TaxonomyService.updatePostTaxonomy(postId, taxonomies)
    },

    create ({ commit }, item) {
      return TaxonomyService
        .create(item)
        .then(resp => {
          const { data } = resp.data
          commit('addItemToList', {
            type: data.type,
            item: data,
          })
          return data
        })
    },

    update ({ commit }, { id, payload }) {
      return TaxonomyService
        .update(id, payload)
        .then((resp) => {
          commit('setItem', payload)
          return resp
        })
    },

    fetchItem ({ commit }, id) {
      commit('beforeFetching')
      return TaxonomyService
        .getById(id, { with: 'translations' })
        .then(resp => {
          const { data } = resp.data
          commit('setItem', data)
          commit('afterFetching')
          return resp
        })
        .catch(e => {
          console.log(e)
          commit('afterFetching')
        })
    },

    fetchListByType ({ commit }, type) {
      return TaxonomyService
        .getAll({ type: type })
        .then(resp => {
          const { data } = resp.data
          commit('setListByType', {
            type: type,
            lists: data,
          })
          return resp
        })
    },
  },
}