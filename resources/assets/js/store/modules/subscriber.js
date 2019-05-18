import { ApiService } from '../../api'
import * as _ from 'lodash'
import axios from 'axios'

export const namespaced = true
const initialState = {
  list: [],
  item: {},
  paginator: {},
  queryParams: {
    sort: 'updated_at',
    direction: 'desc',
    page: 1,
    perPage: 10,
  },
}

export const state = { ...initialState }

const getters = {
  list: state => state.list,
  item: state => state.item,
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
    await ApiService.get('/newsletters', params).then(res => {
      const pagination = res.data.pagination
      const list = res.data.data

      commit('setList', {
        list: list,
        queryParams: params,
      })
      commit('setPaginator', {
        total: pagination.total,
        pageSize: pagination.perPage,
      })
    })
  },
  async getItem ({ commit }, email) {
    await ApiService.get(`/newsletters/${ email }`).then(res => {
      commit('setItem', res.data.data)
    })
  },
  async getDataCSV ({ dispatch }) {
    // await axios.post('https://us15.api.mailchimp.com', {
    //     apikey: '0a1d9c6e34b21c56d1b851b6c3da5562-us15',
    //     id: 'a8c465aa5f',
    // }, {
    //   headers: {
    //     'Content-Type': 'application/json',
    //     'Access-Control-Allow-Origin': '*',
    //   }
    // }).then(res => {
    //       dispatch('subscriber/exportCSV', res)
    //     })
    const axiosInstance = axios.create({
      baseURL: 'https://us15.api.mailchimp.com',
      headers: {
        'Content-Type': 'application/json',
        'Access-Control-Allow-Origin': '*',
      },
    })
    await axiosInstance.post('/export/1.0/list/', {
      apikey: '0a1d9c6e34b21c56d1b851b6c3da5562-us15',
      id: 'a8c465aa5f',
    }).then(res => {
      debugger
      dispatch('subscriber/exportCSV', res)
    })
  },
  async exportCSV ({ commit }, data) {
    await ApiService.post('/newsletter/export', data)
  },
  resetState ({ commit }) {
    commit('resetState')
  },
}

const mutations = {
  setList (state, { list, queryParams = {} }) {
    state.list = list
    state.queryParams = { ...queryParams }
  },
  setItem (state, item) {
    state.item = item
  },
  resetState (state) {
    state.list = []
    state.item = {}
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
