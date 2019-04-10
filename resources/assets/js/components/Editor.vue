<template>
  <div :id="id"></div>
</template>

<script>
  import Jodit from 'jodit'
  import { Cookie } from '@/util'
  import * as _ from 'lodash'

  export default {
    name: 'Editor',
    props: {
      value: { type: String, default: '' },
      id: { type: String, default: 'editor' },
      buttons: { type: Array, default: null },
      extraButtons: { type: Array, default: null },
      config: { type: Object, default: () => ({}) },
    },
    data () {
      return {
        editor: null,
      }
    },
    computed: {
      editorConfig () {
        const config = { ...this.config }
        if (this.buttons) {
          config.buttons = this.buttons
          config.buttonsMD = this.buttons
          config.buttonsSM = this.buttons
          config.buttonsXS = this.buttons
        }
        if (this.extraButtons) config.extraButtons = this.extraButtons

        config.addNewLine = false
        config.addNewLineOnDBLClick = false
        config.enableDragAndDropFileToEditor = true
        config.height = 800
        config.uploader = {
          url: '/api/assets',
          format: 'json',
          headers: {
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Authorization': 'Bearer ' + Cookie.findByName('token'),
          },
          process (resp) {
            const { data } = resp
            const files = _.map(data, 'path')
            return {
              files: files || [],
              baseurl: [window.location.origin, 'storage', ''].join('/'),
            }
          },
          error: function (e) {
            this.events.fire('errorPopap', [e.getMessage(), 'error', 4000])
          },
        }
        return config
      },
    },
    watch: {
      value (newValue) {
        if (this.editor.value !== newValue) this.editor.value = newValue
      },
    },
    mounted () {
      this.editor = new Jodit(`#${ this.id }`, this.editorConfig)
      this.editor.value = this.value || ''
      this.editor.events.on('change', newValue => this.$emit('input', newValue))
      this.editor.events.on('afterImageEditor', newValue => this.$emit('input', newValue))
    },
    beforeDestroy () {
      this.editor.destruct()
    },
  }
</script>