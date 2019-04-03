<template>
    <div class="box">
        <PostList :type="type" @edit="routeToDetail" @routeToNew="routeToNew"></PostList>
    </div>
</template>

<script>
  import PostList from '../components/PostList';
  export default {
    name: 'BlogList',
    components: {PostList},
    beforeRouteLeave(from, to, next) {
      this.$store.dispatch('post/resetState');
      next();
    },
    data() {
      return {
        type: 'blog'
      }
    },
    methods: {
      routeToDetail(id) {
        this.$router.push({name: 'blogDetail', params: {id: id}});
      },
      routeToNew() {
        this.$router.push({name: 'blogNew'});
      }
    }
  };
</script>

<style scoped>

</style>
