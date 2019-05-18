<template>
  <div class="box">
    <PostForm :type="type" :formAction="formAction" @routeToList="routeToList"></PostForm>
  </div>
</template>

<script>
  import PostForm from '../components/PostForm'
  import { mapGetters } from 'vuex'

  export default {
    name: 'PracticeDetail',
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
        type: 'practice',
        formAction: 'edit',
      }
    },
    methods: {
      routeToList () {
        console.log(this.saved)
        this.$router.push({ name: 'practiceList' })
      },
    },
  }
</script>

<style scoped>

</style>
