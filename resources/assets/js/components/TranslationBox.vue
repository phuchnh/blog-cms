<template>
  <div>
    <div class="box box-widget">
      <div class="box-header">
        <h3 class="box-title">Content</h3>
      </div>
      <div class="box-body">
        <a-tabs :defaultActiveKey="activeTab" @change="onTabsChange">
          <a-tab-pane v-for="(trans, index) in translations" :key="index" :tab="trans.locale | localeName">
            <div class="form-group">
              <label for="title">title</label>
              <input type="text" class="form-control" id="title" placeholder="title" v-model="trans.title">
            </div>
            <div class="form-group">
              <label for="slug">description</label>
              <input type="text" class="form-control" id="description" placeholder="description"
                     v-model="trans.description">
            </div>
            <div class="form-group">
              <label for="slug">slug</label>
              <input type="text" class="form-control" id="slug" placeholder="slug" v-model="trans.slug">
            </div>
            <div class="form-group">
              <label>content</label>
              <Editor :id="trans.locale" v-model="trans.content"/>
            </div>
          </a-tab-pane>
        </a-tabs>
      </div>
    </div>
  </div>
</template>

<script>
  import Editor from '@/components/Editor.vue'
  import * as _ from 'lodash'

  export default {
    name: 'TranslationBox',
    components: {
      Editor,
    },
    props: {
      value: {
        type: Array,
        default () {
          return []
        },
      },
    },
    data () {
      return {
        activeTab: 0,
        translations: this.value,
      }
    },
    created () {
      this.translations = [...this.defaultTranslations()]
    },
    watch: {
      translations (newValue, oldValue) {
        if (newValue !== oldValue) {
          this.$emit('input', newValue)
        }
      },
    },
    methods: {
      defaultTranslations () {
        return _.map(['vi', 'en'], (value) => {
          let obj = {}
          obj.locale = value
          obj.title = ''
          obj.slug = ''
          obj.description = ''
          obj.content = ''
          return _.assign({}, obj, _.find(this.translations, (trans) => trans.locale === value) || {})
        })
      },

      onTabsChange (key) {
        this.activeTab = key
      },
    },
  }
</script>

<style scoped>

</style>