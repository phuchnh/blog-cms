<template>
  <div>
    <PostForm formAction="new"></PostForm>
  </div>
</template>

<script>
  import PostForm from '@/components/PostForm'

  export default {
    name: 'NewPost',
    components: {
      PostForm,
    },
  }
</script>

<style scoped>

</style>