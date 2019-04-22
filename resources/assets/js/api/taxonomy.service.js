import { ApiService } from './api.service'

export const TaxonomyService = {
  getAll (params = {}) {
    return ApiService.get('/taxonomies', params)
  },
  getById (id, params = {}) {
    return ApiService.get(`/taxonomies/${ id }`, params)
  },
  create (body = {}) {
    return ApiService.post(`/taxonomies`, body)
  },
  update (id, body = {}) {
    return ApiService.put(`/taxonomies/${ id }`, body)
  },
  updatePostTaxonomy (postId, taxonomies = []) {
    return ApiService.put(`/post/taxonomies/${ postId }`, {
      taxonomies: taxonomies,
    })
  },
  delete (id, params = {}) {
    return ApiService.delete(`/taxonomies/${ id }`, params)
  },
}