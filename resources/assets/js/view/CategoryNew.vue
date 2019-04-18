<template>
  <div class="box">
    <CategoryForm :formAction="formAction" @routeToList="routeToList"></CategoryForm>
  </div>
</template>

<script>
  import CategoryForm from '../components/CategoryForm'
  import store from '@/store'

  export default {
    name: 'CategoryNew',
    components: { CategoryForm },
    beforeRouteEnter (to, from, next) {
      store.dispatch('taxonomy/fetchList', {
        type: 'category',
      }).then(() => next())
    },
    beforeRouteLeave (from, to, next) {
      store.dispatch('taxonomy/reset').then(() => next())
    },
    data () {
      return {
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
