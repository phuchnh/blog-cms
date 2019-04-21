<template>
  <div class="row">
    <div class="col-xs-12 col-md-8">
      <TranslationBox v-model="translations"></TranslationBox>
    </div>
    <div class="col-xs-12 col-md-4">
      <TaxonomyBox :boxTitle="'Group'" :boxType="'group'" :setHierarchy="true" v-model="selectedId"></TaxonomyBox>
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
  import TaxonomyBox from '@/components/TaxonomyBox.vue'

  export default {
    name: 'FaqForm',
    components: {
      TranslationBox,
      TaxonomyBox,
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
        post: this.formValue || {},
        selectedId: this.formValue.selectedId || null,
        translations: this.formValue.translations || [],
      }
    },

    computed: {
      isCreate () {
        return this.formAction === 'new'
      },
    },
    methods: {
      ...mapActions('faq', ['createItem', 'updateItem']),
      ...mapActions('taxonomy', ['updateTaxonomies']),

      onSubmit () {
        this.post.publish = 1
        this.post.type = 'post_faq'
        this.post.translations = [...this.translations]

        if (this.isCreate) {
          this.createItem(this.post).then(() => this.backToList())
        } else {
          this.updateItem(this.post)
              .then((resp) => {
                debugger;
                const payload = {
                  taxonomies: [this.selectedId]
                }
                return this.updateTaxonomies({'id': resp.id, 'payload': payload})
              })
              .then(() => this.backToList())
        }
      },
      backToList () {
        this.$router.push({ name: 'faqList' })
      },

    },
  }
</script>

<style scoped>

</style>