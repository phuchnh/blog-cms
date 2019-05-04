<template>
  <div class="box box-widget">
    <div class="box-header" v-if="boxTitle">
      <h3 class="box-title">{{ boxTitle }}</h3>
    </div>

    <div class="box-body">
      <a-tabs :defaultActiveKey="activeTab" :animated="false" @change="onTabsChange">
        <a-tab-pane v-for="(trans, index) in translations" :key="index" :tab="trans.locale | localeName">
          <div class="form-group">
            <Editor :id="trans.locale" v-model="trans.description"/>
          </div>
        </a-tab-pane>
      </a-tabs>
    </div>
  </div>
</template>

<script>
  import * as _ from 'lodash'
  import Editor from '@/components/Editor.vue'

  export default {
    name: 'ContentBox',
    components: { Editor },
    props: {
      boxTitle: {
        type: String,
        default: '',
      },
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