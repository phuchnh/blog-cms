<template>
  <div>
    <div class="wrapper">
      <Header></Header>
      <Sidebar></Sidebar>
      <PageContent>
        <router-view></router-view>
      </PageContent>
      <Footer></Footer>
    </div>
  </div>
</template>

<script>
  import Header from '@/layouts/Header';
  import Sidebar from '@/layouts/Sidebar';
  import PageContent from '@/layouts/PageContent';
  import Footer from '@/layouts/Footer';

  export default {
    components: {
      Header: Header,
      Sidebar: Sidebar,
      PageContent: PageContent,
      Footer: Footer
    },
    name: 'App',
    mounted () {
      console.log('App');
    },
    created () {
      this.$store.dispatch('setting/fetchList')
    }
  };
</script>

<style scoped>
</style>
