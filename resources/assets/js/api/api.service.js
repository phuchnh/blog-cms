import axios from 'axios'
import { Cookie } from '@/util/cookie'

const axiosInstance = axios.create({
  baseURL: '/api',
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'Accept': 'application/json',
    'Content-Type': 'application/json',
  },
})

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
  axiosInstance.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}

// Add a request interceptor for authorization
axiosInstance.interceptors.request.use(
  (config) => {
    // Do something before request is sent
    config.headers['Authorization'] = `Bearer ${ Cookie.findByName('token') }`
    return config
  },
)

axiosInstance.interceptors.response.use(
  resp => resp,
  error => {
    const { config, response: { status } } = error

    if (status === 401) {
      window.location.href = window.location.origin + '/login'
    }
    return Promise.reject(error);
  },
)

export const ApiService = {

  get (url, params = {}) {
    return axiosInstance.get(`${ url }`, { params })
  },

  post (url, body) {
    return axiosInstance.post(`${ url }`, body)
  },

  put (url, body, params = {}) {
    return axiosInstance.put(`${ url }`, body, { params })
  },

  delete (url, params = {}) {
    return axiosInstance.delete(url, params)
  },
}
