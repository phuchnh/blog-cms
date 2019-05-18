<template>
  <div class="box">
    <div class="box-body">
      <form class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label">ID</label>
          <div class="col-sm-8" style="padding-top: 7px">
            {{ item.id }}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Name</label>
          <div class="col-sm-8" style="padding-top: 7px">
            {{ item.name }}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>
          <div class="col-sm-8" style="padding-top: 7px">
            {{ item.email }}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Date added</label>
          <div class="col-sm-8" style="padding-top: 7px">
            {{ item.created_at | dateTime }}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Last changed</label>
          <div class="col-sm-8" style="padding-top: 7px">
            {{ item.updated_at | dateTime }}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Type</label>
          <div class="col-sm-8" style="padding-top: 7px">
            {{ item.type }}
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-4">
            <button @click="routeToList" class="btn btn-default margin-r-5" type="button">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import store from '@/store'
  import moment from 'moment'

  export default {
    name: 'SubscriptionDetail',
    beforeRouteEnter (to, from, next) {
      Promise.all([
        store.dispatch('subscription/getItem', to.params.id),
      ]).then(() => next())
    },
    beforeRouteLeave (from, to, next) {
      this.$store.dispatch('subscription/resetState').then(() => next())
    },
    filters: {
      dateTime (value) {
        return moment(value).format('MMMM Do YYYY, hh:mm:ss A')
      },
    },
    computed: {
      ...mapGetters('subscription', ['item']),
    },
    methods: {
      routeToList () {
        this.$router.push({ name: 'SubscriptionList' })
      },
    },
  }
</script>

<style scoped>

</style>