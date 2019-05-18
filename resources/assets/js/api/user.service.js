import { ApiService } from './api.service'

export const UserService = {
  getList (params = {}) {
    return ApiService.get('/users', {
      ...params,
    })
  },

  getItem (userId, params = {}) {
    return ApiService.get(`/users/${ userId }`, params)
  },

  create (body = {}) {
    return ApiService.post(`/users`, body)
  },

  update (userId, body = {}) {
    return ApiService.put(`/users/${ userId }`, body)
  },

  delete (userId, params = {}) {
    return ApiService.delete(`/users/${ userId }`, params)
  },

  recentUser () {
    return ApiService.get('/users/recent');
  }
}
