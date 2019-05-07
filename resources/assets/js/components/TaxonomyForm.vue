<template>
  <div class="row">
    <div class="col-xs-12" v-loading="loading">
      <TranslationBox v-model="taxonomy.translations" :useEditor="false"></TranslationBox>
    </div>
    <PostActionBox @click="handleAction" :actions="actions"></PostActionBox>
  </div>
</template>

<script>
  import TranslationBox from '@/components/TranslationBox'
  import PostActionBox from '@/components/PostActionBox'
  import { mapActions, mapGetters } from 'vuex'
  import store from '@/store'

  export default {
    name: 'TaxonomyForm',
    components: {
      TranslationBox,
      PostActionBox,
    },
    data () {
      return {
        actions: [
          {
            title: 'Cancel',
            icon: 'fa fa-times',
            type: 'btn-default',
          },
          {
            title: 'Save',
            icon: 'fa fa-save',
            type: 'btn-success',
          },
        ],
        taxonomy: {
          translations: [],
        },
      }
    },
    created () {
      this.taxonomy = { ...this.getItem }
    },
    computed: {
      ...mapGetters('taxonomies', ['getLoading', 'getItem']),
      loading () {
        return this.getLoading
      },
    },
    beforeRouteEnter (to, from, next) {
      return store.dispatch('taxonomies/fetchItem', to.params.id).then(() => next())
    },

    beforeRouteUpdate (to, from, next) {
      return store.dispatch('taxonomies/fetchItem', to.params.id).then(() => next())
    },
    methods: {
      ...mapActions('taxonomies', ['update']),
      handleAction (action) {
        if (action === 'save') {
          return this.update({ id: this.$route.params.id, payload: this.taxonomy }).then(() => this.$router.go(-1))
        }

        if (action === 'cancel') {
          this.$router.go(-1)
        }
      },
    },
  }
</script>

<style scoped>

</style>