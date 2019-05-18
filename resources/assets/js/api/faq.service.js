import { ApiService } from './api.service'

export const FaqService = {
  getAll (params = {}) {
    return ApiService.get('/faqs', params)
  },
  getById (id, params = {}) {
    return ApiService.get(`/faqs/${ id }`, params)
  },
  create (body = {}) {
    return ApiService.post(`/faqs`, body)
  },
  update (id, body = {}) {
    return ApiService.put(`/faqs/${ id }`, body)
  },
  delete (id, params = {}) {
    return ApiService.delete(`/faqs/${ id }`, params)
  },
}