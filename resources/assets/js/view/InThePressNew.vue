<template>
    <div>
        <!-- Content Header (Page header) -->
        <PageHeader :title="'Create In The Press Page'"></PageHeader>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box">
                <PostForm ref="postForm" :type="type" :formAction="formAction" @routeToList="routeToList"></PostForm>
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
    name: 'InThePressNew',
    components: {PageHeader, PostForm},
    computed: {
      ...mapGetters({
        saved: 'post/saved'
      })
    },
    beforeRouteLeave(from, to, next) {
      if (_.isEmpty(this.$refs.postForm.post)) {
        this.$store.dispatch('post/savedPost', true);
      }
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
        type: 'in_the_press',
        formAction: 'create'
      }
    },
    methods: {
      routeToList() {
        this.$router.push({name: 'inThePressList'});
      }
    }
  };
</script>

<style scoped>

</style>
