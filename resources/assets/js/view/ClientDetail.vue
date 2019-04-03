<template>
    <div>
        <!-- Content Header (Page header) -->
        <PageHeader :title="'Edit Client'"></PageHeader>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box">
                <ClientForm :formAction="formAction" @routeToList="routeToList"></ClientForm>
            </div>
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
  import PageHeader from '../components/PageHeader';
  import {mapGetters} from 'vuex';
  import ClientForm from '../components/ClientForm';
  export default {
    name: 'ClientDetail',
    components: {ClientForm, PageHeader},
    computed: {
      ...mapGetters({
        saved: 'client/saved'
      })
    },
    beforeRouteLeave(from, to, next) {
      if (!this.saved) {
        this.$confirm({
          title: 'Are you sure you want to leave without saving?',
          okText: 'Yes',
          okType: 'danger',
          cancelText: 'No',
          onOk: () => {
            this.$store.dispatch('client/resetState');
            next();
          },
        });
      } else {
        this.$store.dispatch('client/resetState');
        next();
      }
    },
    data() {
      return {
        formAction: 'edit'
      }
    },
    methods: {
      routeToList() {
        console.log(this.saved);
        this.$router.push({name: 'clientList'});
      }
    }
  };
</script>

<style scoped>

</style>
