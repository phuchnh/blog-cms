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
    type: 'company'
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
  async exportCSV ({ commit }, type) {
    await ApiService.post('/newsletters/export', '', {params: type}).then(response => {
      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', `${_.get(type, 'type', '')}_subscriber.csv`);
      document.body.appendChild(link);
      link.click();
    })
  },
  setContactType ({ commit }, type) {
    commit('setContactType', type)
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
  setContactType (state, type) {
    state.queryParams = {...state.queryParams, type: type}
  }
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations,
}
