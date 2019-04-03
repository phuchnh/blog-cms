<template>
    <div class="box">
        <ClientForm ref="clientForm" :formAction="formAction" @routeToList="routeToList"></ClientForm>
    </div>
</template>

<script>
  import ClientForm from '../components/ClientForm';
  import {mapGetters} from 'vuex';
  export default {
    name: 'ClientNew',
    components: {ClientForm},
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
