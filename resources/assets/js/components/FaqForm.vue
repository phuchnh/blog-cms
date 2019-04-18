<template>
  <div>
    <form role="form" @submit.prevent="onSubmit">
      <a-tabs :defaultActiveKey="activeTab" @change="onTabsChange">
        <a-tab-pane v-for="trans of translations" :key="trans.locale" :tab="trans.locale | localeName">
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
      <div class="form-group">
        <button class="btn btn-primary" type="submit">Save</button>
        <button class="btn btn-default" type="button" @click.prevent="backToList">Cancel</button>
      </div>
    </form>
  </div>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex'
  import Editor from '@/components/Editor.vue'

  export default {
    name: 'FaqForm',
    components: {
      Editor,
    },
    data () {
      return {
        activeTab: 'vi',
      }
    },
    props: {
      formAction: {
        type: String,
        default: 'new',
      },
    },
    computed: {
      ...mapGetters('faq', ['getItem', 'getTranslations', 'getTranslationsByName']),
      post () {
        return this.getItem
      },
      translations () {
        return this.getTranslations
      },
    },
    methods: {
      ...mapActions('faq', ['update', 'create']),
      onSubmit () {
        this.post.translations = [...this.translations]
        if (this.formAction === 'new') {
          this.create(this.post).then(() => this.backToList())
        } else {
          this.update(this.post).then(() => this.backToList())
        }
      },
      backToList () {
        this.$router.push({ name: 'faqList' })
      },
      onTabsChange (key) {
        this.activeTab = key
      },
    },
  }
</script>

<style scoped>

</style>