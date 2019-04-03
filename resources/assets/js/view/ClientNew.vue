<template>
    <div>
        <!-- Content Header (Page header) -->
        <PageHeader :title="'Create New Client'"></PageHeader>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box">
                <ClientForm ref="clientForm" :formAction="formAction" @routeToList="routeToList"></ClientForm>
            </div>
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
  import ClientForm from '../components/ClientForm';
  import PageHeader from '../components/PageHeader';
  import {mapGetters} from 'vuex';
  export default {
    name: 'ClientNew',
    components: {PageHeader, ClientForm},
    computed: {
      ...mapGetters({
        saved: 'client/saved'
      })
    },
    beforeRouteLeave(from, to, next) {
      if (_.isEmpty(this.$refs.clientForm.post)) {
        this.$store.dispatch('client/savedPost', true);
      }
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
        formAction: 'create'
      }
    },
    methods: {
      routeToList() {
        this.$router.push({name: 'clientList'});
      }
    }
  };
</script>

<style scoped>

</style>
