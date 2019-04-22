<template>
  <div class="box">
    <CategoryForm :formAction="formAction" @routeToList="routeToList"></CategoryForm>
  </div>
</template>

<script>
  import CategoryForm from '../components/CategoryForm'
  import store from '@/store'

  export default {
    name: 'CategoryDetail',
    components: { CategoryForm },
    beforeRouteEnter (to, from, next) {
      store.dispatch('taxonomy/fetchItem', { id: to.params.id, params: { with: 'translations' } }).then(() => {
        store.dispatch('taxonomy/fetchList', {
          type: 'category',
        })
      }).then(() => next())
    },
    beforeRouteLeave (from, to, next) {
      store.dispatch('taxonomy/reset').then(() => next())
    },
    data () {
      return {
        formAction: 'edit',
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
