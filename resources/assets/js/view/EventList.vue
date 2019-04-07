<template>
    <div class="box">
        <PostList :type="type" @edit="routeToDetail" @routeToNew="routeToNew"></PostList>
    </div>
</template>

<script>
  import PostList from '../components/PostList';
  export default {
    name: 'EventList',
    components: {PostList},
    beforeRouteLeave(from, to, next) {
      this.$store.dispatch('post/resetState');
      next();
    },
    data() {
      return {
        type: 'event'
      }
    },
    methods: {
      routeToDetail(id) {
        this.$router.push({name: 'eventDetail', params: {id: id}});
      },
      routeToNew() {
        this.$router.push({name: 'eventNew'});
      }
    }
  };
</script>

<style scoped>

</style>
