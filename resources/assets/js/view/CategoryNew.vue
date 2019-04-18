<template>
  <div class="box">
    <CategoryForm :formAction="formAction" @routeToList="routeToList"></CategoryForm>
  </div>
</template>

<script>
  import CategoryForm from '../components/CategoryForm'

  export default {
    name: 'CategoryNew',
    components: { CategoryForm },
    beforeRouteLeave (from, to, next) {
      this.$store.dispatch('taxonomy/reset').then(() => next())
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
