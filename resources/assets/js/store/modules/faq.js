import { FaqService } from '@/api';

const state = () => {
    return {
        data: [],
        pagination: {},
        errors: []
    };
};
const getters = {
    getFaqList: state => {
        return state.faqs;
    }
};

const actions = {
    fetchFaqList: ({ commit }, payload) => {
        console.log(payload);
        return FaqService.fetchList().then(response => {
            const data = response.data.data;
            commit('SET_FAQ', data);
        });
    }
};

const mutations = {
    SET_FAQ: (state, payload) => {
        state.data = [...payload];
    },
    UPDATE_ERROR: (state, error) => {
        state.currentUser = {};
        state.errors.push(error);
    }
};

export const FaqModule = { namespaced: true, state, getters, mutations, actions };