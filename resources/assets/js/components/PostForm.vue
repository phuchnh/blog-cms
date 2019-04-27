<template>
  <div class="row" v-loading="loading">
    <div class="col-xs-12 col-md-8">
      <TranslationBox v-model="translations"></TranslationBox>
      <SeoBox v-model="metas.seo"></SeoBox>
    </div>
    <div class="col-xs-12 col-md-4">
      <ImagesBox v-model="metas.thumbnail" :title="'thumbnail'" :limit="1"></ImagesBox>
      <ImagesBox v-model="metas.banner" :title="'banner'" :limit="10"></ImagesBox>
      <CategoryBox :boxTitle="'Groups'" :boxType="'groups'" v-model="groups"></CategoryBox>
      <TagBox :boxTitle="'Tags'" :boxType="'tags'" v-model="tags"></TagBox>
      <PostEventForm v-show="getPostType === 'post_events' || getPostType === 'post_programs'" v-model="metas.event"></PostEventForm>
      <PostOtherForm v-model="metas.others" :boxTitle="'Custom Related Post'" :type="getPostType"></PostOtherForm>
    </div>
    <PostActionBox @click="handleAction"></PostActionBox>
  </div>
</template>

<script>
  import * as _ from 'lodash'
  import { mapActions, mapGetters } from 'vuex'
  import TranslationBox from '@/components/TranslationBox.vue'
  import CategoryBox from '@/components/CategoryBox.vue'
  import TagBox from '@/components/TagBox.vue'
  import PostActionBox from '@/components/PostActionBox.vue'
  import SeoBox from '@/components/SeoBox.vue'
  import PostEventForm from '@/components/PostEventForm.vue'
  import ImagesBox from '@/components/ImagesBox'
  import PostOtherForm from './PostOtherForm'

  export default {
    name: 'PostForm',
    components: {
      PostOtherForm,
      ImagesBox,
      TranslationBox,
      CategoryBox,
      TagBox,
      PostActionBox,
      SeoBox,
      PostEventForm,
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
        post: {
          publish: 0,
        },
        translations: [],
        metas: {
          seo: [],
          event: {},
          thumbnail: null,
          banner: null,
          others: [],
        },
        groups: [],
        tags: [],
      }
    },
    computed: {
      ...mapGetters('faq', ['getLoading', 'getPostType']),
      ...mapGetters('route', {
        redirectToList: 'redirectToList',
      }),

      loading () {
        return this.getLoading
      },

      isCreate () {
        return this.formAction === 'new'
      },
    },

    created () {

      if (Object.keys(this.formValue).length > 0) {
        this.post = { ...this.formValue || {} }
        this.metas = { ...this.formValue.metas || {} }
        this.translations = [...this.formValue.translations]
        this.groups = [...this.getTaxonomyByType('groups')]
        this.tags = [...this.getTaxonomyByType('tags')]
      }

    },

    methods: {
      ...mapActions('faq', ['createItem', 'updateItem']),
      ...mapActions('postMeta', ['updateOrCreateMeta']),
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
          this.createItem(this.post).then((resp) => {
            return Promise.all([
              this.handleSaveToxonomy(resp),
              this.handleSaveMeta(resp),
            ])
          }).then(() => this.backToList())
        }

        // Edit
        if (!this.isCreate) {
          this.updateItem(this.post).then((resp) => {
            return Promise.all([
              this.handleSaveToxonomy(resp),
              this.handleSaveMeta(resp),
            ])
          }).then(() => this.backToList())
        }
      },

      handleSaveMeta (resp) {
        let metas = []
        if (this.metas.seo.length > 0) {
          metas.push({
            meta_key: 'seo',
            meta_value: this.metas.seo,
          })
        }

        if (Object.keys(this.metas.event).length > 0) {
          metas.push({
            meta_key: 'event',
            meta_value: this.metas.event,
          })
        }

        if (this.metas.thumbnail) {
          metas.push({
            meta_key: 'thumbnail',
            meta_value: this.metas.thumbnail,
          })
        }

        if (this.metas.banner) {
          metas.push({
            meta_key: 'banner',
            meta_value: this.metas.banner,
          })
        }

        if (this.metas.others.length > 0) {
          metas.push({
            meta_key: 'others',
            meta_value: this.metas.others,
          })
        }

        if (metas.length === 0) {
          return resp
        }

        return this.updateOrCreateMeta({
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
        this.$router.push({ name: this.redirectToList })
      },

    },
  }
</script>

<style scoped>

</style>
