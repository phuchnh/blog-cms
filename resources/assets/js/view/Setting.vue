<template>
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-widget">
        <!-- /.box-box-body -->
        <div class="box-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="site-name" class="col-sm-2 control-label">Site name</label>
              <div class="col-sm-10">
                <input class="form-control" id="site-name" name="site_name" v-model="settings.site_name"/>
              </div>
            </div>

            <div class="form-group">
              <label for="phone" class="col-sm-2 control-label">Phone</label>
              <div class="col-sm-10">
                <input class="form-control" id="phone" name="phone" v-model="settings.phone"/>
              </div>
            </div>

            <div class="form-group">
              <label for="address" class="col-sm-2 control-label">Address</label>
              <div class="col-sm-10">
                <input class="form-control" id="address" name="address" v-model="settings.address"/>
              </div>
            </div>

            <div class="form-group">
              <label for="facebook" class="col-sm-2 control-label">Facebook</label>
              <div class="col-sm-10">
                <input class="form-control" id="facebook" name="facebook" v-model="settings.facebook"/>
              </div>
            </div>

            <div class="form-group">
              <label for="instagram" class="col-sm-2 control-label">Instagram</label>
              <div class="col-sm-10">
                <input class="form-control" id="instagram" name="instagram" v-model="settings.instagram"/>
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input class="form-control" id="email" name="email" v-model="settings.email"/>
              </div>
            </div>

            <div class="form-group">
              <label for="linkedin" class="col-sm-2 control-label">Linkedin</label>
              <div class="col-sm-10">
                <input class="form-control" id="linkedin" name="linkedin" v-model="settings.linkedin"/>
              </div>
            </div>

            <div class="form-group">
              <label for="copyright" class="col-sm-2 control-label">Copyright</label>
              <div class="col-sm-10">
                <input class="form-control" id="copyright" name="copyright" v-model="settings.copyright"/>
              </div>
            </div>

            <!-- section button -->
            <div class="button-section-fixed">
              <div class="form-group text-center">
                <div class="col-sm-12">
                  <button @click="routeToList" class="btn btn-default margin-r-5" type="button">
                    <i class="fa fa-times"></i> Cancel
                  </button>
                  <button @click="submit" type="button" class="btn btn-success">
                    <i class="fa fa-save"></i> Save
                  </button>
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import store from '@/store'

  export default {
    name: 'Setting',
    computed: {
      ...mapGetters({
        settings: 'setting/settings',
        saved: 'setting/saved',
      }),
    },
    beforeRouteLeave (from, to, next) {
      if (!this.saved) {
        this.$confirm('Are you sure you want to leave without saving?', {
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          type: 'danger',
        }).then(() => {
          this.$store.dispatch('setting/resetState')
          next()
        })
      } else {
        this.$store.dispatch('setting/resetState')
        next()
      }
    },
    beforeRouteEnter (to, from, next) {
      store.dispatch('setting/fetchList').then(
        () => next(
          vm => {
            vm.loading = false
          }),
      )
    },
    data () {
      return {
        formAction: 'edit',
      }
    },
    methods: {
      routeToList () {
        console.log(this.saved)
        this.$router.push({ name: 'clientList' })
      },
    },
  }
</script>

<style scoped>

</style>
