<template>
  <div class="box">
    <CategoryForm :formAction="formAction" @routeToList="routeToList"></CategoryForm>
  </div>
</template>

<script>
  import CategoryForm from '../components/CategoryForm'

  export default {
    name: 'CategoryDetail',
    components: { CategoryForm },
    beforeRouteLeave (from, to, next) {
      this.$store.dispatch('taxonomy/reset').then(() => next())
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
