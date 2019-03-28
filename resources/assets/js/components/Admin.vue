<template>
  <div>
      <h1>{{ messsage }}</h1>
  </div>
</template>

<script>
    export default {
        name: 'Admin',
        data() {
            return {
                messsage: 'Admin'
            };
        },
        mounted() {
            console.log('mounted');
        }
    };
</script>

<style scoped lang="scss">
  .test {
    color: red;
  }
</style>