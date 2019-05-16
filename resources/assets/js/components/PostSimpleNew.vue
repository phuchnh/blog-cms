<template>
  <div>
    <PostForm formAction="new"></PostForm>
  </div>
</template>

<script>
  import PostForm from '@/components/PostSimpleForm'

  export default {
    name: 'PostSimpleNew',
    components: {
      PostForm,
    },
  }
</script>

<style scoped>

</style>