<template>
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img v-if="meta.avatar && meta.avatar.url" v-bind:src="meta.avatar.url" class="img-circle" alt="User Image">
          <img v-else-if="setting.avatar && setting.avatar.url" v-bind:src="setting.avatar.url" class="img-circle" alt="User Image">
          <img v-else src="../../images/default-avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p v-if="currentUser">{{ currentUser.name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <router-link :to="{name: 'navigation'}" tag="li" active-class="active"><a><i class="fa fa-bars"></i> <span>Navigation</span></a></router-link>
        <router-link :to="{name: 'userList'}" tag="li" active-class="active"><a><i class="fa fa-user"></i> <span>User</span></a></router-link>
        <router-link :to="{name: 'clientList'}" tag="li" active-class="active"><a><i class="fa fa-users"></i> <span>Client</span></a></router-link>
        <router-link :to="{name: 'InThePressList'}" tag="li" active-class="active"><a><i class="fa fa-newspaper-o"></i> <span>In The Press</span></a></router-link>
        <router-link :to="{name: 'BlogList'}" tag="li" active-class="active"><a><i class="fa fa-book"></i> <span>Blog</span></a></router-link>
        <router-link :to="{name: 'EventList'}" tag="li" active-class="active"><a><i class="fa fa-calendar"></i> <span>Event</span></a></router-link>
        <router-link :to="{name: 'ProgramList'}" tag="li" active-class="active"><a><i class="fa fa-calendar"></i> <span>Program</span></a></router-link>
        <router-link :to="{name: 'GuideList'}" tag="li" active-class="active"><a><i class="fa fa-sticky-note"></i> <span>Guided Meditation</span></a></router-link>
        <router-link :to="{name: 'PraticeList'}" tag="li" active-class="active"><a><i class="fa fa-heart"></i> <span>Daily Practice</span></a></router-link>
        <router-link :to="{name: 'FaqList'}" tag="li" active-class="active"><a><i class="fa fa-question"></i> <span>FAQ</span></a></router-link>
        <router-link :to="{name: 'setting'}" tag="li" active-class="active"><a><i class="fa fa-gear"></i> <span>Setting</span></a></router-link>
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
      meta () {
        return this.currentUser.meta || {}
      },
      setting () {
        return this.$store.state.setting.list
      }
    },
  }
</script>

<style scoped>

</style>
