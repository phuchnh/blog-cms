<template>
  <div :v-loading="loading">
    <FaqForm formAction="edit" :formValue="formValue"></FaqForm>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import FaqForm from '@/components/FaqForm'
  import store from '@/store'
  import * as _ from 'lodash'

  export default {
    name: 'FaqDetail',
    components: {
      FaqForm,
    },
    computed: {
      ...mapGetters('faq', ['getLoading', 'getItem']),
      ...mapGetters('postMeta', ['getPostMeta']),
      loading () {
        return this.getLoading
      },
      formValue () {
        return {
          ...this.getItem,
          postMeta: this.getPostMeta,
        }
      },
    },
    beforeRouteEnter (to, from, next) {
      Promise.all([
        store.dispatch('faq/fetchItem', to.params.id),
        store.dispatch('postMeta/fetchPostMeta', to.params.id),
      ]).then(() => next())
    },
  }
</script>

<style scoped>

</style>