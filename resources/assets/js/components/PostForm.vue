<template>
  <div class="row" v-loading="loading">
    <div class="col-xs-12 col-md-8">
      <TranslationBox v-model="translations"></TranslationBox>
      <SeoBox v-model="metas.seo"></SeoBox>
    </div>
    <div class="col-xs-12 col-md-4">
      <div class="box box-widget">
        <div class="box-header">
          <h3 class="box-title text-capitalize">Status</h3>
        </div>
        <div class="box-body">
          <PostDisplay v-model="post.publish" :title="'Publish'"></PostDisplay>

          <PostDisplay
              v-show="getPostType === 'post_events' || getPostType === 'post_programs' || getPostType === 'post_presses'"
              v-model="metas.is_home" :title="'Display on HomePage'"></PostDisplay>
        </div>
      </div>

      <ImagesBox v-model="metas.thumbnail" :boxTitle="'thumbnail'" :limit="1" @uploading="uploadImage"></ImagesBox>
      <ImagesBox v-model="metas.banner" :boxTitle="'banner'" :limit="10" @uploading="uploadImage"></ImagesBox>
      <CategoryBox :boxTitle="'Category'" :boxType="'groups'" v-model="groups"></CategoryBox>

      <TagBox :boxTitle="'Tags'" :boxType="'tags'" v-model="tags"></TagBox>
      <PostEventForm v-show="getPostType === 'post_events' || getPostType === 'post_programs'"
                     v-model="metas.event"></PostEventForm>

      <div class="box box-widget"
           v-if="getPostType === 'post_events' || getPostType === 'post_programs'">
        <div class="box-header">
          <h3 class="box-title text-capitalize">Sign Up Now</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <input type="text" class="form-control" id="sign_up_link" placeholder="http://......." v-model="metas.sign_up_link">
          </div>
        </div>
      </div>

      <PostOtherForm v-model="metas.others" :boxTitle="'Custom Related Post'" :type="getPostType"></PostOtherForm>
    </div>
    <PostActionBox @click="handleAction" :disable="imageUploading"></PostActionBox>
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
  import PostOtherForm from '@/components/PostOtherForm'
  import PostDisplay from '@/components/PostDisplay'

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
      PostDisplay,
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
        post: {},
        translations: [],
        metas: {
          seo: [],
          event: {},
          thumbnail: null,
          banner: null,
          others: [],
          is_home: 0,
          sign_up_link: null,
        },
        groups: [],
        tags: [],
        imageUploading: false,
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
      },

      submit () {

        this.post.type = 'post_faq'
        this.post.translations = [...this.translations]

        // Create
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

        if (this.metas.is_home.length > 0) {
          metas.push({
            meta_key: 'is_home',
            meta_value: this.metas.is_home,
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

        if (this.metas.sign_up_link) {
          metas.push({
            meta_key: 'sign_up_link',
            meta_value: this.metas.sign_up_link,
          })
        }

        if (this.metas.others) {
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

      uploadImage (event) {
        this.imageUploading = event
      },

    },
  }
</script>

<style scoped>

</style>
