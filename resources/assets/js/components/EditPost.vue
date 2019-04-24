<template>
  <div :v-loading="loading">
    <PostForm formAction="edit" :formValue="formValue"></PostForm>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import PostForm from '@/components/PostForm'
  import store from '@/store'

  export default {
    name: 'EditPost',
    components: {
      PostForm,
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
          metas: this.getPostMeta,
        }
      },
    },
    beforeRouteEnter (to, from, next) {
      return Promise.all([
        store.dispatch('faq/fetchItem', to.params.id),
        store.dispatch('postMeta/fetchPostMeta', to.params.id),
      ]).then(() => next())
    },
  }
</script>

<style scoped>

</style>