<template>
  <div class="row">
    <div class="col-xs-12 col-md-8">
      <TranslationBox v-model="translations"></TranslationBox>
    </div>
    <div class="col-xs-12 col-md-4">
      <CategoryBox :boxTitle="'Groups'" :boxType="'groups'" v-model="groups"></CategoryBox>
      <TagBox :boxTitle="'Tags'" :boxType="'tags'" v-model="tags"></TagBox>
    </div>
    <div class="button-section-fixed">
      <div class="form-group text-center">
        <div class="col-sm-12">
          <button @click="backToList" class="btn btn-default margin-r-5" type="button">
            <i class="fa fa-times"></i> Cancel
          </button>
          <button @click="onSubmit" type="button" class="btn btn-success">
            <i class="fa fa-save"></i> {{ isCreate ? 'Create' : 'Update'}}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapActions } from 'vuex'
  import TranslationBox from '@/components/TranslationBox.vue'
  import CategoryBox from '@/components/CategoryBox.vue'
  import TagBox from '@/components/TagBox.vue'
  import * as _ from 'lodash'

  export default {
    name: 'FaqForm',
    components: {
      TranslationBox,
      CategoryBox,
      TagBox,
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
        groups: [],
        tags: [],
      }
    },
    computed: {
      isCreate () {
        return this.formAction === 'new'
      },
    },

    created () {

      if (this.formValue) {
        this.post = this.formValue
        this.translations = this.formValue.translations
        this.groups = this.getTaxonomyByType('groups')
        this.tags = this.getTaxonomyByType('tags')
      }

    },

    methods: {
      ...mapActions('faq', ['createItem', 'updateItem']),
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

      onSubmit () {

        this.post.publish = 1
        this.post.type = 'post_faq'
        this.post.translations = [...this.translations]

        // Cretae
        if (this.isCreate) {
          this.createItem(this.post)
              .then((resp) => this.updateCategory(resp))
              .then(() => this.backToList())
        }

        // Edit
        if (!this.isCreate) {
          this.updateItem(this.post)
              .then((resp) => this.updateCategory(resp))
              .then(() => this.backToList())
        }
      },

      updateCategory (resp) {
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