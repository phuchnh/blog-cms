<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ title }}
      </h1>
      <ol class="breadcrumb">
        <li>
          <router-link :to="{name: 'admin'}"><i class="fa fa-dashboard"></i> Home</router-link>
        </li>
        <li class="active">{{ title }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
      <slot></slot>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>

<script>
  export default {
    name: 'PageContent',
    computed: {
      title () {
        return this.$route.meta.title || ''
      },
      description () {
        return this.$route.meta.description || ''
      },
    },
  }
</script>

<style scoped>
  .content-wrapper {
    min-height: 100vh;
  }
</style>
