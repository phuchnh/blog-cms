<template>
    <div>
        <!-- Content Header (Page header) -->
        <PageHeader :title="'List of Blogs'"></PageHeader>

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
    name: 'BlogList',
    components: {PageHeader, PostList},
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
