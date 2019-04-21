import { TaxonomyService } from '@/api'
import Vue from 'vue'

const state = () => {
  return {
    list: null,
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
    const { type } = payload
    const { data } = resp.data
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
    const resp = await TaxonomyService.create(payload)
    const { type } = payload
    const { data } = resp.data
    let items = [...state[type]]
    items.push(data)
    commit('updateStateByName', { key: type, value: items })
    return data
  },

  /**
   *
   * @param commit
   * @param id
   * @param payload
   * @returns {Promise<void>}
   */
  async update ({ commit }, payload) {
    const resp = await TaxonomyService.update(payload.id, payload)
    commit('SET_ITEM', payload)
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
