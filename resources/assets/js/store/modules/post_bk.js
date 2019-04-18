import { ApiService } from '../../api'
import * as _ from 'lodash'

export const namespaced = true

const initialState = {
  posts: [],
  post: {},
  item: {},
  saved: false,
  paginator: {},
}

export const state = { ...initialState }

const getters = {
  post: state => state.post,
  posts: state => state.posts,
  saved: state => state.saved,
  pagination: state => state.paginator,

  getItem: state => {
    return state.post
  },

  getTranslations: (state, getters) => {

    const defaultTranslations = _.map(['vi', 'en'], (value) => {
      return { locale: value, title: '', slug: '', description: '', content: '' }
    })

    if (Object.keys(getters.getItem).length === 0) {
      return defaultTranslations
    }

    let translations = [...getters.getItem.translations]

    if (translations.length === 1) {
      translations = _.assign([], defaultTranslations, translations)
    }

    // Default locale is vi to top
    return translations.sort((a, b) => (a.id - b.id))
  },
}

const actions = {
  getPostList ({ commit }, params) {
    return ApiService.get('/posts', params).then(res => {
      const pagination = res.data.pagination
      const posts = res.data.data

      commit('setPosts', posts)
      commit('setPaginator', {
        total: pagination.total,
        pageSize: pagination.perPage,
      })
    })
  },
  getPost ({ commit }, { id, params }) {
    return ApiService.get(`/posts/${ id }`, params).then(res => {
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
  deletePermanentlyPost ({ commit }, id) {
    return ApiService.delete(`posts/${ id }/permanent`).then(() => {
      commit('deletePost', id)
    })
  },
  restorePost ({ commit }, id) {
    return ApiService.put(`posts/${ id }/restore`)
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
  setPaginator: (state, paginator) => {
    state.paginator = { ...paginator }
  },
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations,
}
