<template>
  <div class="formSection">
    <CategoryForm ref="postForm" :type="type" :formAction="formAction" @routeToList="routeToList"></CategoryForm>
  </div>
</template>

<script>
  import CategoryForm from '../components/CategoryForm'
  import { mapGetters } from 'vuex'

  export default {
    name: 'CategoryNew',
    components: { CategoryForm },
    computed: {
      ...mapGetters({
        saved: 'post/saved',
      }),
    },
    beforeRouteLeave (from, to, next) {
      if (_.isEmpty(this.$refs.postForm.post)) {
        this.$store.dispatch('post/savedPost', true)
      }
      if (!this.saved) {
        this.$confirm({
          title: 'Are you sure you want to leave without saving?',
          okText: 'Yes',
          okType: 'danger',
          cancelText: 'No',
          onOk: () => {
            this.$store.dispatch('post/resetState')
            next()
          },
        })
      } else {
        this.$store.dispatch('post/resetState')
        next()
      }
    },
    data () {
      return {
        type: 'category',
        formAction: 'create',
      }
    },
    methods: {
      routeToList () {
        this.$router.push({ name: 'categoryList' })
      },
    },
  }
</script>

<style scoped>

</style>
