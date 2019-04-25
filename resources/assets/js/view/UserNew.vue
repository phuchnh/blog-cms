<template>
  <div class="box">
    <UserForm ref="userForm" :formAction="formAction" @routeToList="routeToList"></UserForm>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import UserForm from '../components/UserForm'

  export default {
    name: 'UserNew',
    components: { UserForm },
    beforeRouteLeave (from, to, next) {
      this.$store.dispatch('user/resetState').then(() => next())
    },
    data () {
      return {
        formAction: 'create',
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
