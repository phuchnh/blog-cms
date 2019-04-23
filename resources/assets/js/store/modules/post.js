import { ApiService } from '@/api'
import * as _ from 'lodash'

const state = () => {
  return {
    list: [],
    item: {},
    paginator: {},
    errors: [],
  }
}
const getters = {
  /**
   *
   * @param state
   * @returns {*}
   */
  getAll: state => {
    return state.list
  },

  getItem: state => {
    return state.item
  },

  getTranslations: (state, getters) => {
    const defaultTranslations = _.map(['vi', 'en'], (value) => {
      return {
        locale: value,
        title: '',
        slug: '',
        description: '',
        content: '',
      }
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
  async fetchList ({ commit }, params) {
    const resp = await ApiService.get('/posts', params)
    const { data } = resp.data
    const { pagination } = resp.data

    commit('SET_LIST', data)
    commit('SET_PAGINATOR', pagination)

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
    const resp = await ApiService.get(`/posts/${ id }`, params)
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
  async create ({ dispatch, commit }, payload) {
    let input = _.omit(payload, ['meta'])

    const resp = await ApiService.post('/posts', input)
    const { data } = resp.data

    commit('SET_ITEM', data)

    // insert to meta table
    await dispatch('meta/updateMeta', { data: payload.meta, model: 'posts', model_id: data.id }, { root: true })

    return resp
  },

  /**
   *
   * @param commit
   * @param id
   * @param payload
   * @returns {Promise<void>}
   */
  async update ({ dispatch, commit }, payload) {
    let input = _.omit(payload, ['meta'])

    const resp = await ApiService.put(`/posts/${ payload.id }`, input)
    const { data } = resp.data

    commit('SET_ITEM', data)

    // insert to meta table
    await dispatch('meta/updateMeta', { data: payload.meta, model: 'post', post_id: data.id }, { root: true })

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
    const resp = await ApiService.delete(`posts/${ id }`)
    const { data } = resp.data
    commit('SET_ITEM', data)
    return resp
  },

  /**
   * reset all state
   * @param commit
   * @returns {Promise<void>}
   */
  async reset ({ commit }) {
    commit('RESET_STATE')
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
  RESET_STATE: (state) => {
    state.list = []
    state.item = {}
    state.paginator = {}
    state.errors = []
  },
}

export default { namespaced: true, state, getters, mutations, actions }