<template>
  <div class="formSection">
    <PostForm :type="type" :formAction="formAction" @routeToList="routeToList"></PostForm>
  </div>
</template>

<script>
  import PostForm from '../components/PostForm'
  import { mapGetters } from 'vuex'

  export default {
    name: 'BlogDetail',
    components: { PostForm },
    computed: {
      ...mapGetters({
        saved: 'post/saved',
      }),
    },
    beforeRouteLeave (from, to, next) {
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
        type: 'blog',
        formAction: 'edit',
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
