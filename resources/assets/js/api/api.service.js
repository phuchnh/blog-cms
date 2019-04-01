import axios from 'axios';

export const ApiService = {
    init: () => {
        axios.defaults.baseURL = '/api';
    },

    get(url, params = '') {
        return axios.get(`${url}`, {params: params});
    },

    post(url, body, headers) {
        return axios.post(`${url}`, body, {headers: headers});
    },

    put(url, params, body) {
        return axios.put(`${url}/${params}`, body);
    },

    delete(url) {
        return axios.delete(url);
    }
};
