<template>
  <div class="formSection">
    <PostForm :type="type"
              :formAction="formAction"
              @routeToList="routeToList"></PostForm>
  </div>
</template>

<script>
  import PostForm from '../components/PostForm'
  import { mapGetters } from 'vuex'
  import store from '@/store'

  export default {
    name: 'PostDetail',
    components: { PostForm },
    computed: {
      ...mapGetters('post', {
        faq: 'getItem',
      }),
    },
    beforeRouteEnter (to, from, next) {
      store.dispatch('post/fetchItem', { id: to.params.id, params: { with: 'translations' } }).then(() => next())
    },
    beforeRouteUpdate (to, from, next) {
      store.dispatch('post/fetchItem', to.params.id).then(() => next())
    },
    beforeRouteLeave (to, from, next) {
      store.dispatch('post/reset')
      next()
    },
    data () {
      return {
        type: this.$route.query.type,
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
