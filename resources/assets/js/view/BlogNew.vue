<template>
    <div>
        <!-- Content Header (Page header) -->
        <PageHeader :title="'Create Blog'"></PageHeader>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box">
                <PostForm :type="type" :formAction="formAction" @routeToList="routeToList"></PostForm>
            </div>
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
  import PageHeader from '../components/PageHeader';
  import PostForm from '../components/PostForm';
  export default {
    name: 'BlogNew',
    components: {PageHeader, PostForm},
    data() {
      return {
        type: 'blog',
        formAction: 'create'
      }
    },
    methods: {
      routeToList() {
        this.$router.push({name: 'blogList'});
      }
    }
  };
</script>

<style scoped>

</style>
