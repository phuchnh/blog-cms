<template>
  <div>
    <PostForm formAction="new" @back-to-list="back"></PostForm>
  </div>
</template>

<script>
  import PostForm from '@/components/PostForm'

  export default {
    name: 'NewPost',
    components: {
      PostForm,
    },
    methods: {
      back () {
        debugger
      }
    }
  }
</script>

<style scoped>

</style>