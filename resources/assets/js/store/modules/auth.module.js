const initialState = {
    user: {},
    isAuthenticated: false,
    errors: null
};

const getters = {
    currentUser(state) {
        return state.user;
    },
    isAuthenticated(state) {
        return state.isAuthenticated;
    }
};

const actions = {
    login(context, credentials) {
    },
    checkAuth(context) {
    }
};

const mutations = {
    setCurrentUser(state, user) {
        state.isAuthenticated = true;
        state.user = user;
        state.errors = null;
    },
    setAuthError(state, error) {
        state.errors = error;
    }
};
