<template>
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p v-if="currentUser">{{ currentUser.name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <router-link :to="{name: 'userList'}" tag="li" active-class="active"><a><i class="fa fa-link"></i> <span>User</span></a></router-link>
        <li class="treeview">
          <router-link :to="{name: 'inThePressList'}">
            <i class="fa fa-link"></i> <span>In The Press</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </router-link>
          <ul class="treeview-menu">
            <router-link :to="{name: 'inThePressTrashList'}" tag="li" active-class="active"><a><i class="fa fa-trash"></i> <span>Trash</span></a></router-link>
          </ul>
        </li>
        <router-link :to="{name: 'blogList'}" tag="li" active-class="active"><a><i class="fa fa-link"></i> <span>Blog</span></a></router-link>
        <router-link :to="{name: 'eventList'}" tag="li" active-class="active"><a><i class="fa fa-link"></i> <span>Event</span></a></router-link>
        <router-link :to="{name: 'guideList'}" tag="li" active-class="active"><a><i class="fa fa-link"></i> <span>Guided Meditation</span></a></router-link>
        <router-link :to="{name: 'practiceList'}" tag="li" active-class="active"><a><i class="fa fa-link"></i> <span>Daily Practice</span></a></router-link>
        <router-link :to="{name: 'clientList'}" tag="li" active-class="active"><a><i class="fa fa-link"></i> <span>Client</span></a></router-link>
        <!--<router-link :to="{name: 'blogList'}" tag="li" active-class="active"><a><i class="fa fa-link"></i> <span>Subscriber</span></a></router-link>-->
        <router-link :to="{name: 'faqList'}" tag="li" active-class="active"><a><i class="fa fa-link"></i> <span>FAQ</span></a></router-link>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
  export default {
    name: 'Sidebar',
    computed: {
      currentUser () {
        return this.$store.state.auth.currentUser
      },
    },
  }
</script>

<style scoped>

</style>
