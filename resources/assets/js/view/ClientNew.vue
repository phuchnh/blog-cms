<template>
  <div class="box">
    <ClientForm ref="clientForm" :formAction="formAction" @routeToList="routeToList"></ClientForm>
  </div>
</template>

<script>
  import ClientForm from '../components/ClientForm'

  export default {
    name: 'ClientNew',
    components: { ClientForm },
    beforeRouteLeave (from, to, next) {
      this.$store.dispatch('client/resetState').then(() => next())
    },
    data () {
      return {
        formAction: 'create',
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
