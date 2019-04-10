<template>
  <form role="form" @submit.prevent="onSubmit">
    <div class="form-group">
      <label for="title">title</label>
      <input type="text" class="form-control" id="title" placeholder="title" v-model="faq.title">
    </div>
    <div class="form-group">
      <label for="description">description</label>
      <input type="text" class="form-control" id="description" placeholder="description" v-model="faq.description">
    </div>
    <div class="form-group">
      <label for="slug">slug</label>
      <input type="text" class="form-control" id="slug" placeholder="slug" v-model="faq.slug">
    </div>
    <div class="form-group">
      <label>content</label>
      <Editor name="content" v-model="faq.content"/>
    </div>
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Save</button>
      <button class="btn btn-default" type="button" @click.prevent="backToList">Cancel</button>
    </div>
  </form>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex'
  import Editor from '@/components/Editor.vue'

  export default {
    name: 'FaqForm',
    components: { Editor },
    props: {
      formAction: {
        type: String,
        default: 'new',
      },
    },
    computed: {
      ...mapGetters('faq', {
        faq: 'getItem',
      }),
    },
    methods: {
      ...mapActions('faq', [
        'update',
        'create',
      ]),
      onSubmit () {
        if (this.formAction === 'new') {
          this.create(this.faq).then(() => this.backToList())
        } else {
          this.update(this.faq).then(() => this.backToList())
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