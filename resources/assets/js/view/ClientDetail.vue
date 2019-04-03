<template>
    <div class="box">
        <ClientForm :formAction="formAction" @routeToList="routeToList"></ClientForm>
    </div>
</template>

<script>
  import {mapGetters} from 'vuex';
  import ClientForm from '../components/ClientForm';
  export default {
    name: 'ClientDetail',
    components: {ClientForm},
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
