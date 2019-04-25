<template>
  <div class="box">
    <UserForm :formAction="formAction" @routeToList="routeToList"></UserForm>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import UserForm from '../components/UserForm'
  import store from '@/store'

  export default {
    name: 'UserDetail',
    components: { UserForm },
    beforeRouteEnter (to, from, next) {
      Promise.all([
        store.dispatch('user/getItem', to.params.id),
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
        this.$router.push({ name: 'userList' })
      },
    },
  }
</script>

<style scoped>

</style>
