<template>
    <div class="box">
        <PostForm ref="postForm" :type="type" :formAction="formAction" @routeToList="routeToList"></PostForm>
    </div>
</template>

<script>
  import PostForm from '../components/PostForm';
  import {mapGetters} from 'vuex';
  export default {
    name: 'EventNew',
    components: {PostForm},
    computed: {
      ...mapGetters({
        saved: 'post/saved'
      })
    },
    beforeRouteLeave(from, to, next) {
      if (_.isEmpty(_.omit(this.$refs.postForm.post, 'content'))) {
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
        type: 'event',
        formAction: 'create'
      }
    },
    methods: {
      routeToList() {
        this.$router.push({name: 'eventList'});
      }
    }
  };
</script>

<style scoped>

</style>
