<template>
  <div class="formSection">
    <PostForm ref="postForm" :type="type" :formAction="formAction" @routeToList="routeToList"></PostForm>
  </div>
</template>

<script>
  import PostForm from '../components/PostForm'
  import { mapGetters, mapMutations } from 'vuex'

  export default {
    name: 'BlogNew',
    components: { PostForm },
    data () {
      return {
        type: 'blog',
        formAction: 'create',
      }
    },
    methods: {
      ...mapMutations('post', {
        resetForm: 'RESET_ITEM',
      }),
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
