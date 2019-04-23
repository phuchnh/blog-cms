<template>
  <div class="formSection">
    <PostForm ref="postForm" :type="type" :formAction="formAction" @routeToList="routeToList"></PostForm>
  </div>
</template>

<script>
  import PostForm from '../components/PostForm'
  import { mapGetters, mapMutations } from 'vuex'

  export default {
    name: 'PostNew',
    components: { PostForm },
    data () {
      return {
        type: this.$route.query.type,
        formAction: 'create',
      }
    },
    methods: {
      routeToList () {
        this.$router.push({ name: 'blogList' })
      },
    },
  }
</script>

<style scoped>

</style>
