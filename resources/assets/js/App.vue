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
    import Header from '@/components/Header';
    import Sidebar from '@/components/Sidebar';
    import PageContent from '@/components/PageContent';
    import Footer from '@/components/Footer';

    export default {
        components: {
            Header: Header,
            Sidebar: Sidebar,
            PageContent: PageContent,
            Footer: Footer
        },
        name: 'App'
    };
</script>

<style scoped>
</style>
