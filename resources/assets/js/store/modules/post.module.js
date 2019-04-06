import { ApiService } from '../../api'
import moment from 'moment'

export const namespaced = true

const initialState = {
  posts: [],
  post: {},
  saved: false,
}

export const state = { ...initialState }

const getters = {
  post: state => state.post,
  posts: state => state.posts,
  saved: state => state.saved,
}

const actions = {
  getPostList ({ commit }, type) {
    const params = {
      type: type,
    }
    return ApiService.get('/posts', params).then(res => {
      commit('setPosts', res.data.data)
    })
  },
  getPost ({ commit }, id) {
    return ApiService.get(`/posts/${ id }`).then(res => {
      commit('setPost', res.data.data)
    })
  },
  deletePost ({ commit }, id) {
    return ApiService.delete(`posts/${ id }`).then(() => {
      commit('deletePost', id)
    })
  },
  updatePost ({ dispatch, commit }, payload) {
    let input = _.omit(payload, ['meta'])

    return ApiService.put(`/posts/${ payload.id }`, input).then((res) => {
      commit('setPost', res.data.data)

      // insert to meta table
      dispatch('meta/updateMeta', { data: payload.meta, post_id: res.data.data.id }, { root: true })
    })
  },
  createPost ({ dispatch, commit }, payload) {
    let input = _.omit(payload, ['meta'])

    return ApiService.post('/posts', input).then((res) => {
      commit('setPost', res.data.data)

      // insert to meta table
      dispatch('meta/createMeta', { data: payload.meta, post_id: res.data.data.id }, { root: true })
    })
  },
  resetState ({ commit }) {
    commit('resetState')
  },
  savedPost ({ commit }, payload) {
    commit('savedPost', payload)
  },
}

const mutations = {
  setPosts (state, posts) {
    state.posts = posts
  },
  setPost (state, post) {
    state.post = post
  },
  deletePost (state, id) {
    state.posts = _.filter(state.posts, (item) => {
      return item.id !== id
    })
  },
  resetState (state) {
    state.post = {}
    state.posts = []
    state.saved = false
  },
  savedPost (state, saved) {
    state.saved = saved
  },
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations,
}
