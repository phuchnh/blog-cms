<template>
  <div>
    <h1> {{ message }}</h1>
  </div>
</template>

<script>
    export default {
        name: 'Dashboard',
        mounted() {
            console.log('Dashboard');
        },
        data() {
            return {
                message: 'Dashboard'
            };
        }
    };
</script>

<style scoped>

</style>