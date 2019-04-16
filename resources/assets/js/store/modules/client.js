import {ApiService} from '../../api';

export const namespaced = true;
const initialState = {
  clients: [],
  client: {},
  saved: false,
  paginator: {},
};

export const state = { ...initialState };

const getters = {
  client: state => state.client,
  clients: state => state.clients,
  saved: state => state.saved,
  pagination: state => state.paginator
};

const actions = {
  getClientList({commit}, params) {
    return ApiService.get('/clients', params).then(res => {
      const pagination = res.data.pagination
      const clients = res.data.data

      commit('setClients', clients)
      commit('setPaginator', {
        total: pagination.total,
        pageSize: pagination.perPage,
      })
    });
  },
  getClient({commit}, id) {
    return ApiService.get(`/clients/${id}`).then(res => {
      commit('setClient', res.data.data);
    });
  },
  deleteClient({commit}, id) {
    return ApiService.delete(`/clients/${id}`).then(() => {
      commit('deleteClient', id);
    });
  },
  updateClient({commit}, payload) {
    return ApiService.put(`/clients/${payload.id}`, payload);
  },
  createClient({commit}, payload) {
    ApiService.post('/clients', payload);
  },
  resetState({commit}) {
    commit('resetState');
  },
  savedClient({commit}, payload) {
    commit('savedClient', payload);
  }
};

const mutations = {
  setClients(state, clients) {
    state.clients = clients;
  },
  setClient(state, client) {
    state.client = client;
  },
  deleteClient(state, id) {
    state.clients = _.filter(state.clients, (item) => {
      return item.id !== id;
    });
  },
  resetState(state) {
    state.client = {};
    state.clients = [];
    state.saved = false;
  },
  savedClient(state, saved) {
    state.saved = saved;
  },
  setPaginator: (state, paginator) => {
    state.paginator = { ...paginator }
  },
};

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations,
};
