import { TaxonomyService } from '@/api'
import Vue from 'vue'

const state = () => {
  return {
    list: [],
    item: {},
    paginator: {},
    errors: [],
  }
}
const getters = {
  getAll: state => {
    return state.list
  },
  getItem: state => {
    return state.item
  },
  getPaginator: state => {
    return state.paginator
  },
  getTranslations: (state, getters) => {

    const defaultTranslations = _.map(['vi', 'en'], (value) => {
      return { locale: value, title: '', slug: '' }
    })

    if (Object.keys(getters.getItem).length === 0) {
      return defaultTranslations
    }

    let translations = [...getters.getItem.translations]

    if (translations.length === 1) {
      translations = _.assign([], defaultTranslations, translations)
    }

    // Default locale is vi to top
    return translations.sort((a, b) => (a.id - b.id))
  },
  getListByType: state => (type) => {
    return state[type] || []
  },
}

const actions = {
  /**
   *
   * @param commit
   * @param payload
   * @returns {Promise<void>}
   */
  async fetchList ({ commit }, payload) {
    const resp = await TaxonomyService.getAll(payload)
    const pagination = resp.data.pagination
    const { data } = resp.data
    const { type } = payload

    commit('SET_LIST', data)

    if (pagination) {
      commit('SET_PAGINATOR', {
        total: pagination.total,
        pageSize: pagination.perPage,
      })
    }

    commit('addStateByName', { key: type, value: data })
    return resp
  },
  /**
   *
   * @param commit
   * @param id
   * @param payload
   * @returns {Promise<void>}
   */
  async fetchItem ({ commit }, { id, params }) {
    const resp = await TaxonomyService.getById(id, params)
    const { data } = resp.data
    commit('SET_ITEM', data)
    return resp
  },

  /**
   *
   * @param commit
   * @param state
   * @param payload
   * @returns {Promise<void>}
   */
  async create ({ commit, state }, payload) {
    let input = _.omit(payload, ['meta'])
    const resp = await TaxonomyService.create(input)
    const { type } = payload
    const { data } = resp.data
    let items = [...state[type]]
    items.push(data)
    commit('updateStateByName', { key: type, value: items })

    // insert to meta table
    await dispatch('meta/updateMeta', { data: payload.meta, model: 'taxonomies', model_id: payload.id }, { root: true })
    return data
  },

  /**
   *
   * @param commit
   * @param id
   * @param payload
   * @returns {Promise<void>}
   */
  async update ({ commit, dispatch }, payload) {
    let input = _.omit(payload, ['translations.meta'])
    const resp = await TaxonomyService.update(payload.id, input)
    commit('SET_ITEM', payload)
    // insert to meta table
    await dispatch('meta/updateMeta', { data: payload.meta, model: 'taxonomies', model_id: payload.id }, { root: true })
    return resp
  },

  /**
   *
   * @param commit
   * @param id
   * @param payload
   * @returns {Promise<void>}
   */
  async delete ({ commit }, id, payload) {
    const resp = await TaxonomyService.delete(id, payload)
    const { data } = resp.data
    commit('SET_ITEM', data)
    return resp
  },

  /**
   *
   * @param commit
   * @param id
   * @returns {Promise<void>}
   */
  async reset ({ commit }) {
    commit('RESET_ITEM')
  },
}
const mutations = {
  addStateByName: (state, { key, value }) => {
    Vue.set(state, key, value)
  },

  updateStateByName: (state, { key, value }) => {
    Vue.set(state, key, value)
  },

  SET_LIST: (state, data) => {
    state.list = [...data]
  },
  SET_PAGINATOR: (state, paginator) => {
    state.paginator = { ...paginator }
  },
  SET_ITEM: (state, item) => {
    state.item = { ...item }
  },
  RESET_ITEM: (state) => {
    state.list = []
    state.item = {}
    state.paginator = {}
    state.errors = []
  },
}

export default { namespaced: true, state, getters, mutations, actions }
