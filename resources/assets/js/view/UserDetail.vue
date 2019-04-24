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
    computed: {
      ...mapGetters({
        saved: 'user/saved',
      }),
    },
    beforeRouteEnter (to, from, next) {
      Promise.all([
        store.dispatch('user/getItem', to.params.id),
        store.dispatch('user/saved', true)
      ]).then(() => next())
    },
    beforeRouteLeave (from, to, next) {
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
