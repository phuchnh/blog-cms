<template>
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
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
        <li>
          <router-link :to="{name: 'userList'}"><i class="fa fa-link"></i> <span>User</span></router-link>
        </li>
        <li>
          <router-link :to="{name: 'inThePressList'}"><i class="fa fa-link"></i> <span>In The Press</span>
          </router-link>
        </li>
        <li>
          <router-link :to="{name: 'blogList'}"><i class="fa fa-link"></i> <span>Guided Meditation</span>
          </router-link>
        </li>
        <li>
          <router-link :to="{name: 'blogList'}"><i class="fa fa-link"></i> <span>Daily Practice</span>
          </router-link>
        </li>
        <li>
          <router-link :to="{name: 'blogList'}"><i class="fa fa-link"></i> <span>Client</span></router-link>
        </li>
        <li>
          <router-link :to="{name: 'blogList'}"><i class="fa fa-link"></i> <span>Subscriber</span>
          </router-link>
        </li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        <li>
          <router-link :to="{name: 'faq'}"><i class="fa fa-link"></i> <span>FAQ</span></router-link>
        </li>
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
      currentUser() {
        return this.$store.state.auth.currentUser;
      }
    }
  };
</script>

<style scoped>

</style>
