import {ApiService} from '../../api';

export const namespaced = true;
const initialState = {
  users: [],
  user: {},
  saved: false,
  paginator: {},
};

export const state = { ...initialState };

const getters = {
  user: state => state.user,
  users: state => state.users,
  saved: state => state.saved,
  pagination: state => state.paginator,
};

const actions = {
  getUserList({commit}, params) {
    return ApiService.get('/users', params).then(res => {
      const pagination = res.data.pagination
      const users = res.data.data

      commit('setUsers', users)
      commit('setPaginator', {
        total: pagination.total,
        pageSize: pagination.perPage,
      })
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
    return ApiService.put(`/users/${payload.id}`, payload);
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
