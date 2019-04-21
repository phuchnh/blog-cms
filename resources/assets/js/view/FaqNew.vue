<template>
  <div>
    <FaqForm formAction="new"></FaqForm>
  </div>
</template>

<script>
  import FaqForm from '@/components/FaqForm'
  import TaxonomyBox from '@/components/TaxonomyBox.vue'

  export default {
    name: 'FaqNew',
    components: {
      FaqForm,
      TaxonomyBox,
    },
  }
</script>

<style scoped>

</style>