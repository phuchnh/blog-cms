<template>
    <div>
        <!-- Content Header (Page header) -->
        <PageHeader :title="'In The Press Page'"></PageHeader>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box">
                <PostList :type="type" @edit="routeToDetail" @routeToNew="routeToNew"></PostList>
            </div>
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
  import PostList from '../components/PostList';
  import PageHeader from '../components/PageHeader';
  export default {
    name: 'InThePress',
    components: {PageHeader, PostList},
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
