<template>
  <div class="box">
    <PostList :type="type" :routeDetailName="'blogDetail'" @routeToNew="routeToNew"></PostList>
  </div>
</template>

<script>
  import store from '@/store'
  import PostList from '../components/PostList'

  export default {
    name: 'BlogList',
    components: { PostList },
    data () {
      return {
        type: 'blog',
        routeNewName: 'blogNew',
      }
    },
    /**
     * load all list items
     * @param to
     * @param from
     * @param next
     */
    beforeRouteEnter (to, from, next) {
      store.dispatch('post/fetchList', {
        sort: 'updated_at',
        direction: 'desc',
        type: 'blog',
        page: 1,
        perPage: 10,
        only: 'id,slug,title,description',
      }).then(
        () => next(
          vm => {
            vm.loading = false
          }),
      )
    },
    beforeRouteUpdate (to, from, next) {
      this.loading = true
      store.dispatch('post/fetchItem', to.params.id).then(
        () => {
          this.loading = false
          next()
        },
      )
    },
    /**
     * reset all state in store
     * @param from
     * @param to
     * @param next
     */
    beforeRouteLeave (from, to, next) {
      store.dispatch('post/reset')
      next()
    },
    methods: {
      routeToNew () {
        this.$router.push({ name: 'blogNew' })
      },
    },
  }
</script>

<style scoped>

</style>
