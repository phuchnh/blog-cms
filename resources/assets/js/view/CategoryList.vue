<template>
  <div class="box">
    <PostList :type="type" @edit="routeToDetail" @routeToNew="routeToNew"></PostList>
  </div>
</template>

<script>
  import PostList from '../components/PostList';
  export default {
    name: 'CategoryList',
    components: {PostList},
    beforeRouteLeave(from, to, next) {
      this.$store.dispatch('post/resetState');
      next();
    },
    data() {
      return {
        type: 'category'
      }
    },
    methods: {
      routeToDetail(id) {
        this.$router.push({name: 'categoryDetail', params: {id: id}});
      },
      routeToNew() {
        this.$router.push({name: 'categoryDetail'});
      }
    }
  };
</script>

<style scoped>

</style>
