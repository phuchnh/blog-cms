import { ApiService } from './api.service'

export const PostService = {
  getPosts (postType, params = {}) {
    return ApiService.get('/posts', {
      ...params,
      type: postType,
    })
  },

  getPost (postId, params = {}) {
    return ApiService.get(`/posts/${ postId }`, params)
  },

  createPost (body = {}) {
    return ApiService.post(`/posts`, body)
  },

  updatePost (postId, body = {}) {
    return ApiService.put(`/posts/${ postId }`, body)
  },

  deletePost (postId, params = {}) {
    return ApiService.delete(`/posts/${ postId }`, params)
  },

  recentPost (params = {}) {
    return ApiService.get('/posts/recent', params)
  }
}
