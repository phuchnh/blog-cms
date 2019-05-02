<template>
  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <router-link :to="{name: 'admin'}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <img src="../../images/onelifeconnection-logo.png" style="width: 70%" alt="Website logo">
      </span>
    </router-link>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="/" target="_blank">
              <i class="fa fa-globe"></i>
              <span>View Website</span>
            </a>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img v-if="meta.avatar" v-bind:src="meta.avatar" class="user-image" alt="User Image">
              <img v-else src="../../images/default-avatar.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ currentUser.name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img v-if="meta.avatar" v-bind:src="meta.avatar" class="img-circle" alt="User Image">
                <img v-else src="../../images/default-avatar.png" class="img-circle" alt="User Image">

                <p>
                  {{ currentUser.name }} - {{ currentUser.type | capitalize }}
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <router-link :to="{name: 'userDetail', params: {id: currentUser.id}}"
                               class="btn btn-default btn-flat">Profile
                  </router-link>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat"
                     onclick="event.preventDefault(); document.getElementById('logout').submit();">Sign out</a>
                  <form id="logout" action="/logout" method="POST" style="display: none;">
                    <input type="hidden" :value="csrf" name="_token">
                    <input type="_method" value="post">
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
  export default {
    name: 'Header',
    computed: {
      currentUser () {
        return this.$store.state.auth.currentUser
      },
      meta () {
        return this.currentUser.meta || {}
      },
      csrf () {
        return document.head.querySelector('meta[name="csrf-token"]').content
      },
    },
  }
</script>

<style scoped>

</style>
