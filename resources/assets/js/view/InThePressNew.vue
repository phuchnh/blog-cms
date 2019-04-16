<template>
  <div class="box">
    <PostForm ref="postForm" :type="type" :formAction="formAction" @routeToList="routeToList"></PostForm>
  </div>
</template>

<script>
  import PostForm from '../components/PostForm'
  import { mapGetters } from 'vuex'

  export default {
    name: 'InThePressNew',
    components: { PostForm },
    computed: {
      ...mapGetters({
        saved: 'post/saved',
      }),
    },
    beforeRouteLeave (from, to, next) {
      if (_.isEmpty(_.omit(this.$refs.postForm.post, 'content'))) {
        this.$store.dispatch('post/savedPost', true)
      }
      if (!this.saved) {
        this.$confirm('Are you sure you want to leave without saving?', {
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          type: 'danger',
        }).then(() => {
          this.$store.dispatch('post/resetState')
          next()
        })
      } else {
        this.$store.dispatch('post/resetState')
        next()
      }
    },
    data () {
      return {
        type: 'in_the_press',
        formAction: 'create',
      }
    },
    methods: {
      routeToList () {
        this.$router.push({ name: 'inThePressList' })
      },
    },
  }
</script>

<style scoped>

</style>
