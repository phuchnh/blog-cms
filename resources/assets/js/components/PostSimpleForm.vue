<template>
  <div class="row" v-loading="loading">
    <div class="col-xs-12 col-md-8">
      <TranslationBox v-model="translations"></TranslationBox>
    </div>
    <div class="col-xs-12 col-md-4">
      <div class="box box-widget">
        <div class="box-header">
          <h3 class="box-title text-capitalize">Status</h3>
        </div>
        <div class="box-body">
          <PostDisplay v-model="post.publish" :title="'Publish'"></PostDisplay>
        </div>
      </div>

      <ImagesBox v-model="metas.thumbnail" :boxTitle="'thumbnail'" :limit="1" @uploading="uploadImage"></ImagesBox>
    </div>
    <PostActionBox @click="handleAction" :disable="imageUploading"></PostActionBox>
  </div>
</template>

<script>
  import * as _ from 'lodash'
  import { mapActions, mapGetters } from 'vuex'
  import TranslationBox from '@/components/TranslationBox.vue'
  import PostActionBox from '@/components/PostActionBox.vue'
  import ImagesBox from '@/components/ImagesBox'
  import PostDisplay from '@/components/PostDisplay'

  export default {
    name: 'PostSimpleForm',
    components: {
      ImagesBox,
      TranslationBox,
      PostActionBox,
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
          thumbnail: null,
        },
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
      }

    },

    methods: {
      ...mapActions('faq', ['createItem', 'updateItem']),
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
              this.handleSaveMeta(resp),
            ])
          }).then(() => this.backToList())
        }

        // Edit
        if (!this.isCreate) {
          this.updateItem(this.post).then((resp) => {
            return Promise.all([
              this.handleSaveMeta(resp),
            ])
          }).then(() => this.backToList())
        }
      },

      handleSaveMeta (resp) {
        let metas = []
        if (this.metas.thumbnail) {
          metas.push({
            meta_key: 'thumbnail',
            meta_value: this.metas.thumbnail,
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

      backToList () {
        this.$router.push({ name: this.redirectToList })
      },

      uploadImage (event) {
        this.imageUploading = event
      },
    },
  }
</script>