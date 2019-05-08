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
              <span class="info-box-number">{{ totalUsers }}</span>
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
              <span class="info-box-number">{{ totalClients }}</span>
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
              <span class="info-box-number">{{ totalBlogs }}</span>
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
              <span class="info-box-number">{{ totalEvents }}</span>
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
              <span class="info-box-number">{{ totalPrograms }}</span>
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
      Promise.all([
        store.dispatch('user/getList'),
        store.dispatch('client/getList'),
        store.dispatch('faq/fetchListByType', { type: 'post_blogs' }),
        store.dispatch('faq/fetchListByType', { type: 'post_events' }),
        store.dispatch('faq/fetchListByType', { type: 'post_programs' }),
      ]).then(() => next())
    },
    beforeRouteLeave (from, to, next) {
      Promise.all([
        store.dispatch('faq/resetState'),
        store.dispatch('user/resetState'),
      ]).then(() => next())
    },
    computed: {
      ...mapGetters({
        clients: 'client/clients',
        users: 'user/users',
        loading: 'faq/getLoading',
        redirectToDetail: 'route/redirectToDetail',
        queryParams: 'faq/getQueryParams'
      }),
      blogs () {
        return this.$store.getters['faq/getListByType']('post_blogs')
      },
      events () {
        return this.$store.getters['faq/getListByType']('post_events')
      },
      programs () {
        return this.$store.getters['faq/getListByType']('post_programs')
      },
      posts () {
        return this.$store.getters['faq/getLists']
      },
    },
    mounted () {
      // console.log(router.options.routes[0].children)
      // console.log(router.options.routes[0].children.find((value) => {
      //   return value.props && value.props.postType === 'post_blogs'
      // }));
      this.totalUsers = this.users.length
      this.totalClients = this.clients.length
      this.totalBlogs = this.blogs.length
      this.totalEvents = this.events.length
      this.totalPrograms = this.programs.length
    },
    data () {
      return {
        totalUsers: 0,
        totalClients: 0,
        totalBlogs: 0,
        totalEvents: 0,
        totalPrograms: 0,
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
