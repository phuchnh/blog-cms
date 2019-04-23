<template>
  <div :v-loading="loading">
    <FaqForm formAction="edit" :formValue="formValue"></FaqForm>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import FaqForm from '@/components/FaqForm'
  import store from '@/store'

  export default {
    name: 'FaqDetail',
    components: {
      FaqForm,
    },
    computed: {
      ...mapGetters('faq', ['getLoading', 'getItem']),
      loading () {
        return this.getLoading
      },
      formValue () {
        return this.getItem
      },
    },
    beforeRouteEnter (to, from, next) {
      store.dispatch('faq/fetchItem', to.params.id)
           .then(() => next())
    },
  }
</script>

<style scoped>

</style>