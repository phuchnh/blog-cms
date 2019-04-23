<template>
  <div class="row" v-loading="loading">
    <div class="col-xs-12 col-md-8">
      <TranslationBox v-model="translations"></TranslationBox>
      <SeoBox v-model="postMeta.seo"></SeoBox>
    </div>
    <div class="col-xs-12 col-md-4">
      <CategoryBox :boxTitle="'Groups'" :boxType="'groups'" v-model="groups"></CategoryBox>
      <TagBox :boxTitle="'Tags'" :boxType="'tags'" v-model="tags"></TagBox>
    </div>
    <PostActionBox @click="handleAction"></PostActionBox>
  </div>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex'
  import TranslationBox from '@/components/TranslationBox.vue'
  import CategoryBox from '@/components/CategoryBox.vue'
  import TagBox from '@/components/TagBox.vue'
  import PostActionBox from '@/components/PostActionBox.vue'
  import SeoBox from '@/components/SeoBox.vue'
  import * as _ from 'lodash'

  export default {
    name: 'FaqForm',
    components: {
      TranslationBox,
      CategoryBox,
      TagBox,
      PostActionBox,
      SeoBox,
    },
    props: {
      formAction: {
        type: String,
        default: 'new',
      },
      formValue: {
        type: Object,
        default () {
          return {}
        },
      },
    },
    data () {
      return {
        post: null,
        translations: [],
        postMeta: {
          seo: [],
        },
        groups: [],
        tags: [],
      }
    },
    computed: {
      ...mapGetters('faq', ['getLoading']),

      loading () {
        return this.getLoading
      },

      isCreate () {
        return this.formAction === 'new'
      },
    },

    created () {

      if (this.formValue) {
        this.post = { ...this.formValue }
        this.postMeta = { ...this.formValue.postMeta }
        this.translations = [...this.formValue.translations]
        this.groups = [...this.getTaxonomyByType('groups')]
        this.tags = [...this.getTaxonomyByType('tags')]
      }

    },

    methods: {
      ...mapActions('faq', ['createItem', 'updateItem']),
      ...mapActions('postMeta', ['createPostMeta']),
      ...mapActions('taxonomies', ['updatePostTaxonomy']),

      getTaxonomyByType (type) {
        const { taxonomies } = this.formValue
        return _.reduce(taxonomies, (result, value) => {
          if (value.type === type) {
            result.push(value.id)
          }
          return result
        }, [])
      },

      handleAction (action) {
        if (action === 'cancel') {
          this.backToList()
        }

        if (action === 'save') {
          this.submit()
        }

        if (action === 'publish') {
          this.post.publish = 1
          this.submit()
        }
      },

      submit () {

        this.post.type = 'post_faq'
        this.post.translations = [...this.translations]

        // Cretae
        if (this.isCreate) {
          this.createItem(this.post)
              .then((resp) => {
                return Promise.all([
                  this.handleSaveToxonomy(resp),
                  this.handleSavePostMeta(resp),
                ])
              })
              .then(() => this.backToList())
        }

        // Edit
        if (!this.isCreate) {
          this.updateItem(this.post)
              .then((resp) => {
                return Promise.all([
                  this.handleSaveToxonomy(resp),
                  this.handleSavePostMeta(resp),
                ])
              })
              .then(() => this.backToList())
        }
      },

      handleSavePostMeta (resp) {
        let metas = []
        if (this.postMeta.seo.length > 0) {
          metas.push({
            meta_key: 'seo',
            meta_value: this.postMeta.seo,
          })
        }

        if (metas.length === 0) {
          return resp
        }

        return this.createPostMeta({
          postId: resp.id,
          metas: metas,
        })
      },

      handleSaveToxonomy (resp) {
        let taxonomies = []

        if (this.groups.length > 0) {
          // Merge groups to taxonomies
          taxonomies = [...taxonomies, ...this.groups]
        }

        if (this.tags.length > 0) {
          // Merge tags to taxonomies
          taxonomies = [...taxonomies, ...this.tags]
        }

        if (taxonomies.length === 0) {
          return resp
        }

        return this.updatePostTaxonomy({ 'postId': resp.id, 'taxonomies': taxonomies })
      },

      backToList () {
        this.$router.push({ name: 'faqList' })
      },

    },
  }
</script>

<style scoped>

</style>