<template>
  <div>
      <PageHeader :title="'Page Not Found'"></PageHeader>
  </div>
</template>

<script>
    import PageHeader from './../components/PageHeader';
    export default {
        name: 'PageNotFound',
        components: {PageHeader},
        data() {
            return {
                message: 'PageNotFounds'
            };
        }
    };
</script>

<style scoped>

</style>
