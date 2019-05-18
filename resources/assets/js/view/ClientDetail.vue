<template>
  <div class="box">
    <ClientForm :formAction="formAction" @routeToList="routeToList"></ClientForm>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import ClientForm from '../components/ClientForm'
  import store from '@/store'

  export default {
    name: 'ClientDetail',
    components: { ClientForm },
    beforeRouteEnter (to, from, next) {
      Promise.all([
        store.dispatch('client/getItem', to.params.id),
      ]).then(() => next())
    },
    beforeRouteLeave (from, to, next) {
      this.$store.dispatch('client/resetState').then(() => next())
    },
    data () {
      return {
        formAction: 'edit',
      }
    },
    methods: {
      routeToList () {
        this.$router.push({ name: 'clientList' })
      },
    },
  }
</script>

<style scoped>

</style>
