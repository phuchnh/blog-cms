import { FaqService } from '@/api'

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
}

const actions = {
  /**
   *
   * @param commit
   * @param payload
   * @returns {Promise<void>}
   */
  async fetchList ({ commit }, payload) {
    const resp = await FaqService.getAll(payload)
    const { data } = resp.data
    const { pagination } = resp.data
    commit('SET_LIST', data)
    commit('SET_PAGINATOR', {
      total: pagination.total,
      pageSize: pagination.perPage,
    })
    return resp
  },
  /**
   *
   * @param commit
   * @param id
   * @param payload
   * @returns {Promise<void>}
   */
  async fetchItem ({ commit }, id, payload) {
    const resp = await FaqService.getById(id, payload)
    const { data } = resp.data
    commit('SET_ITEM', data)
    return resp
  },

  /**
   *
   * @param commit
   * @param payload
   * @returns {Promise<void>}
   */
  async create ({ commit }, payload) {
    const resp = await FaqService.create(payload)
    const { data } = resp.data
    commit('SET_ITEM', data)
    return resp
  },

  /**
   *
   * @param commit
   * @param id
   * @param payload
   * @returns {Promise<void>}
   */
  async update ({ commit }, payload) {
    const resp = await FaqService.update(payload.id, payload)
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
    const resp = await FaqService.delete(id, payload)
    const { data } = resp.data
    commit('SET_ITEM', data)
    return resp
  },
}
const mutations = {
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
    state.item = {}
  },
}

export const FaqModule = { namespaced: true, state, getters, mutations, actions }