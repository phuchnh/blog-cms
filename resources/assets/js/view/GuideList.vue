<template>
  <div class="box">
    <PostList :type="type" @edit="routeToDetail" @routeToNew="routeToNew"></PostList>
  </div>
</template>

<script>
  import PostList from '../components/PostList'

  export default {
    name: 'GuideList',
    components: { PostList },
    beforeRouteLeave (from, to, next) {
      this.$store.dispatch('post/resetState')
      next()
    },
    data () {
      return {
        type: 'guide',
      }
    },
    methods: {
      routeToDetail (id) {
        this.$router.push({ name: 'guideDetail', params: { id: id } })
      },
      routeToNew () {
        this.$router.push({ name: 'guideNew' })
      },
    },
  }
</script>

<style scoped>

</style>
