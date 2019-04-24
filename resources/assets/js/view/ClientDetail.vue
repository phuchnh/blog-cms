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
    computed: {
      ...mapGetters({
        saved: 'client/saved',
      }),
    },
    beforeRouteEnter (to, from, next) {
      Promise.all([
        store.dispatch('client/getItem', to.params.id),
        store.dispatch('client/saved', true)
      ]).then(() => next())
    },
    beforeRouteLeave (from, to, next) {
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
