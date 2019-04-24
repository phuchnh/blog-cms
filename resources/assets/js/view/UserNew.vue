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
    computed: {
      ...mapGetters({
        saved: 'user/saved',
      }),
    },
    beforeRouteLeave (from, to, next) {
      if (_.isEmpty(this.$refs.userForm.user)) {
        this.$store.dispatch('user/saved', true)
      }
      if (!this.saved) {
        this.$confirm('Are you sure you want to leave without saving?', {
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          type: 'danger',
        }).then(() => {
          this.$store.dispatch('user/resetState')
          next()
        }).catch(() => {})
      } else {
        this.$store.dispatch('user/resetState')
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
        this.$router.push({ name: 'userList' })
      },
    },
  }
</script>

<style scoped>

</style>
