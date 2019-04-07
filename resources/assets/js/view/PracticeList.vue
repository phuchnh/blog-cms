<template>
    <div class="box">
        <PostList :type="type" @edit="routeToDetail" @routeToNew="routeToNew"></PostList>
    </div>
</template>

<script>
  import PostList from '../components/PostList';
  export default {
    name: 'PracticeList',
    components: {PostList},
    beforeRouteLeave(from, to, next) {
      this.$store.dispatch('post/resetState');
      next();
    },
    data() {
      return {
        type: 'practice'
      }
    },
    methods: {
      routeToDetail(id) {
        this.$router.push({name: 'practiceDetail', params: {id: id}});
      },
      routeToNew() {
        this.$router.push({name: 'practiceNew'});
      }
    }
  };
</script>

<style scoped>

</style>
