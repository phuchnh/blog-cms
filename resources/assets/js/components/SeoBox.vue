<template>
  <div class="box box-widget">
    <div class="box-header">
      <h3 class="box-title">Search Engine Optimization</h3>
    </div>
    <div class="box-body">
      <a-tabs :defaultActiveKey="activeTab" :animated="false" @change="onTabsChange">
        <a-tab-pane v-for="(trans, index) in translations" :key="index" :tab="trans.locale | localeName">
          <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" id="title" placeholder="title" v-model="trans.title">
          </div>
          <div class="form-group">
            <label for="keywords">keywords</label>
            <input type="text" class="form-control" id="keywords" placeholder="keywords" v-model="trans.keywords">
          </div>
          <div class="form-group">
            <label for="description">description</label>
            <textarea class="form-control" id="description" placeholder="description"
                      v-model="trans.description" style="min-height: 10rem"></textarea>
          </div>
        </a-tab-pane>
      </a-tabs>
    </div>
    </div>
  </div>
</template>

<script>
  import * as _ from 'lodash'

  export default {
    name: 'SeoBox',
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
          obj.keywords = ''
          obj.description = ''
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