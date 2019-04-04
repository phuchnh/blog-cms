<template>
  <form role="form">
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
      <label for="content">content</label>
      <input type="text" class="form-control" id="content" placeholder="content" v-model="faq.content">
    </div>
    <div class="form-group">
      <button class="btn btn-primary">Save</button>
    </div>
  </form>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    name: 'FaqForm',
    computed: {
      ...mapGetters('faq', {
        faq: 'getItem',
      }),
    },
  }
</script>

<style scoped>

</style>