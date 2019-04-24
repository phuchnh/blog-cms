<template>
  <router-view></router-view>
</template>

<script>

  import { createNamespacedHelpers, mapActions } from 'vuex'
  import store from '@/store'

  export default {
    name: 'PostContainer',
    props: ['redirectToNew', 'redirectToDetail', 'redirectToList', 'postType'],

    beforeRouteEnter (to, from, next) {
      console.log('beforeRouteEnter', to.meta.postType)
      return store.dispatch('faq/setPostType', to.meta.postType).then(() => next())
    },

    beforeRouteUpdate (to, from, next) {
      console.log('beforeRouteUpdate')
      return store.dispatch('faq/setPostType', to.meta.postType).then(() => {
        this.setNew(this.redirectToNew)
        this.setDetail(this.redirectToDetail)
        this.setList(this.redirectToList)
        next()
      })
    },

    beforeRouteLeave (to, from, next) {
      return store.dispatch('faq/setPostType', '').then(() => next())
    },

    created () {
      console.log('created')
      this.setNew(this.redirectToNew)
      this.setDetail(this.redirectToDetail)
      this.setList(this.redirectToList)
    },

    watch: {

      redirectToNew (newValue, oldValue) {
        if (newValue !== oldValue) {
          this.setNew(newValue)
        }
      },

      redirectToDetail (newValue, oldValue) {
        if (newValue !== oldValue) {
          this.setDetail(newValue)
        }
      },

      redirectToList (newValue, oldValue) {
        if (newValue !== oldValue) {
          this.setList(newValue)
        }
      },
    },

    methods: {
      ...mapActions('route', ['setNew', 'setDetail', 'setList']),
    },
  }
</script>

<style scoped>
</style>