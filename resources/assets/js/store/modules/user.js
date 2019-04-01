import {ApiService} from '../../api';

export const namespaced = true;
const initialState = {
  users: [],
  user: {},
  saved: false
};

export const state = { ...initialState };

const getters = {
  user: state => state.user,
  users: state => state.users,
  saved: state => state.saved
};

const actions = {
  getUserList({commit}) {
    return ApiService.get('/users').then(res => {
      commit('setUsers', res.data.data);
    });
  },
  getUser({commit}, id) {
    console.log(id);
    return ApiService.get(`/users/${id}`).then(res => {
      commit('setUser', res.data.data);
    });
  },
  deleteUser({commit}, id) {
    return ApiService.delete(`users/${id}`).then(() => {
      commit('deleteUser', id);
    });
  },
  updateUser({commit}, payload) {
    return ApiService.put('/users', payload.id, payload);
  },
  // createUser({commit}, payload) {
  //   ApiService.post('/users', payload);
  // },
  resetState({commit}) {
    commit('resetState');
  },
  savedUser({commit}, payload) {
    commit('savedUser', payload);
  }
};

const mutations = {
  setUsers(state, users) {
    state.users = users;
  },
  setUser(state, user) {
    state.user = user;
  },
  deleteUser(state, id) {
    state.users = _.filter(state.users, (item) => {
      return item.id !== id;
    });
  },
  resetState(state) {
    state.user = {};
    state.users = [];
    state.saved = false;
  },
  savedUser(state, saved) {
    state.saved = saved;
  }
};

export const UserModule = { namespaced: true, state, getters, mutations, actions };
