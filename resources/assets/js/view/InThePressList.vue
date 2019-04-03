<template>
    <div class="box">
        <PostList :type="type" @edit="routeToDetail" @routeToNew="routeToNew"></PostList>
    </div>
</template>

<script>
  import PostList from '../components/PostList';
  export default {
    name: 'InThePress',
    components: {PostList},
    beforeRouteLeave(from, to, next) {
      this.$store.dispatch('post/resetState');
      next();
    },
    data() {
      return {
        type: 'in_the_press'
      }
    },
    methods: {
      routeToDetail(id) {
        this.$router.push({name: 'inThePressDetail', params: {id: id}});
      },
      routeToNew() {
        this.$router.push({name: 'inThePressNew'});
      }
    }
  };
</script>

<style scoped>

</style>
