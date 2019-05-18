<template>
  <div>
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Users</span>
              <span class="info-box-number">{{ summary.user }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Clients</span>
              <span class="info-box-number">{{ summary.client }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Blogs</span>
              <span class="info-box-number">{{ post.post_blogs }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Events</span>
              <span class="info-box-number">{{ post.post_events }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Programs</span>
              <span class="info-box-number">{{ post.post_programs }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <recent-post></recent-post>
        <recent-user></recent-user>
      </div>
    </section>
  </div>
</template>

<script>
  import { Cookie } from '@/util/cookie'
  import store from '@/store'
  import { mapGetters } from 'vuex'
  import RecentPost from '../components/RecentPost'
  import RecentUser from '../components/RecentUser'

  export default {
    name: 'Dashboard',
    components: { RecentUser, RecentPost },
    beforeRouteEnter (to, from, next) {
      store.dispatch('dashboard/getSummary').then(() => next())
    },
    beforeRouteLeave (from, to, next) {
      Promise.all([
        store.dispatch('faq/resetState'),
        store.dispatch('user/resetState'),
      ]).then(() => next())
    },
    computed: {
      ...mapGetters({
        summary: 'dashboard/getSummary'
      }),
      post () {
        return this.summary.post
      }
    },
    methods: {
      goToDetail (id) {
        return { name: this.redirectToDetail, params: { id: id } }
      },
    }
  }
</script>

<style scoped>

</style>
