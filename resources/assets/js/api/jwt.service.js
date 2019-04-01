const TOKEN_KEY = 'accessToken';

export const getToken = () => {
    return window.localStorage.getItem(TOKEN_KEY);
};

export const setToken = token => {
    window.localStorage.setItem(TOKEN_KEY, token);
};

export const removeToken = () => {
    window.localStorage.removeItem(TOKEN_KEY);
};

export const JwtService = { getToken, setToken, removeToken };
