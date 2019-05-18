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
          <label class="col-sm-2 control-label">Email ID</label>
          <div class="col-sm-8" style="padding-top: 7px">
            {{ item.unique_email_id }}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Name</label>
          <div class="col-sm-8" style="padding-top: 7px">
            {{ item.merge_fields.MMERGE3 }}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>
          <div class="col-sm-8" style="padding-top: 7px">
            {{ item.email_address  }}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Date added</label>
          <div class="col-sm-8" style="padding-top: 7px">
            {{ item.timestamp_opt | dateTime }}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Last changed</label>
          <div class="col-sm-8" style="padding-top: 7px">
            {{ item.last_changed | dateTime }}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Status</label>
          <div class="col-sm-8" style="padding-top: 7px">
            {{ item.status | capitalize }}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Source</label>
          <div class="col-sm-8" style="padding-top: 7px">
            {{ item.source }}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Contact rating</label>
          <div class="col-sm-8" style="padding-top: 7px">
            <el-rate
                v-model="item.member_rating"
                disabled
                text-color="#ff9900">
            </el-rate>
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
    name: 'SubscriberDetail',
    beforeRouteEnter (to, from, next) {
      Promise.all([
        store.dispatch('subscriber/getItem', to.params.email),
      ]).then(() => next())
    },
    beforeRouteLeave (from, to, next) {
      this.$store.dispatch('subscriber/resetState').then(() => next())
    },
    filters: {
      dateTime (value) {
        return moment(value).format('MMMM Do YYYY, hh:mm:ss A')
      }
    },
    computed: {
      ...mapGetters('subscriber', ['item'])
    },
    methods: {
      routeToList () {
        this.$router.push({ name: 'SubscriberList' })
      },
    },
  }
</script>

<style scoped>

</style>
