import { Cookie } from '@/util';
import { AuthService } from '@/api';

const state = () => {
    return {
        currentUser: {},
        isAuthenticated: !!Cookie.findByName('token'),
        errors: []
    };
};
const getters = {};

const actions = {
    CHECK_AUTH: ({ commit }) => {
        return AuthService.fetchUser().then(
            (data) => {
                commit('UPDATE_USER', data);
                return data;
            },
            (error) => commit('UPDATE_ERROR', error)
        );
    }
};

const mutations = {
    UPDATE_USER: (state, payload) => {
        state.currentUser = payload;
    },
    UPDATE_ERROR: (state, error) => {
        state.currentUser = {};
        state.errors.push(error);
    }
};

export const AuthModule = { namespaced: true, state, getters, mutations, actions };