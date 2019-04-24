<template>
  <div class="box">
    <ClientForm ref="clientForm" :formAction="formAction" @routeToList="routeToList"></ClientForm>
  </div>
</template>

<script>
  import ClientForm from '../components/ClientForm'
  import { mapGetters } from 'vuex'

  export default {
    name: 'ClientNew',
    components: { ClientForm },
    computed: {
      ...mapGetters({
        saved: 'client/saved',
      }),
    },
    beforeRouteLeave (from, to, next) {
      if (_.isEmpty(this.$refs.clientForm.client)) {
        this.$store.dispatch('client/saved', true)
      }
      if (!this.saved) {
        this.$confirm('Are you sure you want to leave without saving?', {
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          type: 'danger',
        }).then(() => {
          this.$store.dispatch('client/resetState')
          next()
        }).catch(() => {})
      } else {
        this.$store.dispatch('client/resetState')
        next()
      }
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
