<template>
  <div class="box">
    <PostTrashList :type="type"></PostTrashList>
  </div>
</template>

<script>
  import PostTrashList from '../components/PostTrashList'

  export default {
    name: 'InThePressTrashList',
    components: { PostTrashList },
    beforeRouteLeave (from, to, next) {
      this.$store.dispatch('post/resetState')
      next()
    },
    data () {
      return {
        type: 'in_the_press',
      }
    },
  }
</script>

<style scoped>

</style>
