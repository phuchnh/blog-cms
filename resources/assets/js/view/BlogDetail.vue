<template>
    <div>
        <!-- Content Header (Page header) -->
        <PageHeader :title="'Edit Blog'"></PageHeader>

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
  import PostForm from '../components/PostForm';
  import PageHeader from '../components/PageHeader';
  import {mapGetters} from 'vuex';
  export default {
    name: 'BlogDetail',
    components: {PageHeader, PostForm},
    computed: {
      ...mapGetters({
        saved: 'post/saved'
      })
    },
    beforeRouteLeave(from, to, next) {
      if (!this.saved) {
        this.$confirm({
          title: 'Are you sure you want to leave without saving?',
          okText: 'Yes',
          okType: 'danger',
          cancelText: 'No',
          onOk: () => {
            this.$store.dispatch('post/resetState');
            next();
          },
        });
      } else {
        this.$store.dispatch('post/resetState');
        next();
      }
    },
    data() {
      return {
        type: 'blog',
        formAction: 'edit'
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
