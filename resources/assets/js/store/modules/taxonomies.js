import Vue from 'vue'
import { TaxonomyService } from '@/api'

export default {
  namespaced: true,

  state: () => {
    return {
      loading: false,
    }
  },

  getters: {
    getListByType: (state) => (type) => {
      return state[type]
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