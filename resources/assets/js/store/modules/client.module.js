import {ApiService} from '../../api';

export const namespaced = true;
const initialState = {
  clients: [],
  client: {},
  saved: false
};

export const state = { ...initialState };

const getters = {
  client: state => state.client,
  clients: state => state.clients,
  saved: state => state.saved
};

const actions = {
  getClientList({commit}, type) {
    const params = {
      type: type
    };
    return ApiService.get('/clients', params).then(res => {
      commit('setClients', res.data.data);
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
  }
};

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations,
};
