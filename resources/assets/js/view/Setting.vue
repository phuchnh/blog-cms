<template>
  <div class="boxSection">
    <form class="form-horizontal">
      <div class="row">
        <div class="col-xs-12">
          <a-tabs defaultActiveKey="1" tabPosition="left" :animated="false">

            <!-- General Information -->
            <a-tab-pane tab="General Information" key="1">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">General Informaion</h3>
                </div>

                <div class="box-body">
                  <div class="form-group" :class="{ 'has-error': errors.first('site_name') }">
                    <label for="site-name" class="col-sm-2 control-label">Site name <span
                        class="required">*</span></label>
                    <div class="col-sm-10">
                      <input v-validate="'required'" class="form-control" id="site-name" name="site_name"
                             v-model="settings.site_name"/>
                      <div class="help-block" v-if="errors.first('site_name')">
                        <span>{{ errors.first('site_name') }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group" :class="{ 'has-error': errors.first('phone') }">
                    <label for="phone" class="col-sm-2 control-label">Phone <span class="required">*</span></label>
                    <div class="col-sm-10">
                      <input v-validate="'required'" class="form-control" id="phone" name="phone"
                             v-model="settings.phone"/>
                      <div class="help-block" v-if="errors.first('phone')">
                        <span>{{ errors.first('phone') }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group" :class="{ 'has-error': errors.first('address') }">
                    <label for="address" class="col-sm-2 control-label">Address <span class="required">*</span></label>
                    <div class="col-sm-10">
                      <input v-validate="'required'" class="form-control" id="address" name="address"
                             v-model="settings.address"/>
                      <div class="help-block" v-if="errors.first('address')">
                        <span>{{ errors.first('address') }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group" :class="{ 'has-error': errors.first('facebook') }">
                    <label for="facebook" class="col-sm-2 control-label">Facebook <span
                        class="required">*</span></label>
                    <div class="col-sm-10">
                      <input v-validate="'required'" class="form-control" id="facebook" name="facebook"
                             v-model="settings.facebook"/>
                      <div class="help-block" v-if="errors.first('facebook')">
                        <span>{{ errors.first('facebook') }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group" :class="{ 'has-error': errors.first('instagram') }">
                    <label for="instagram" class="col-sm-2 control-label">Instagram <span
                        class="required">*</span></label>
                    <div class="col-sm-10">
                      <input v-validate="'required'" class="form-control" id="instagram" name="instagram"
                             v-model="settings.instagram"/>
                      <div class="help-block" v-if="errors.first('instagram')">
                        <span>{{ errors.first('instagram') }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group" :class="{ 'has-error': errors.first('email') }">
                    <label for="email" class="col-sm-2 control-label">Email <span class="required">*</span></label>
                    <div class="col-sm-10">
                      <input v-validate="'required|email'" class="form-control" id="email" name="email"
                             v-model="settings.email"/>
                      <div class="help-block" v-if="errors.first('email')">
                        <span>{{ errors.first('email') }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group" :class="{ 'has-error': errors.first('linkedin') }">
                    <label for="linkedin" class="col-sm-2 control-label">Linkedin <span
                        class="required">*</span></label>
                    <div class="col-sm-10">
                      <input v-validate="'required'" class="form-control" id="linkedin" name="linkedin"
                             v-model="settings.linkedin"/>
                      <div class="help-block" v-if="errors.first('linkedin')">
                        <span>{{ errors.first('linkedin') }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group" :class="{ 'has-error': errors.first('copyright') }">
                    <label for="copyright" class="col-sm-2 control-label">Copyright <span
                        class="required">*</span></label>
                    <div class="col-sm-10">
                      <input v-validate="'required'" class="form-control" id="copyright" name="copyright"
                             v-model="settings.copyright"/>
                      <div class="help-block" v-if="errors.first('copyright')">
                        <span>{{ errors.first('copyright') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a-tab-pane>

            <!-- Introduction -->
            <a-tab-pane tab="Introduction" key="2">
              <div class="tab-form">
                <introduction-box v-model="meta.introduction.content"></introduction-box>

                <image-box v-model="meta.introduction.image"
                           :title="'Introduction Image'"></image-box>
              </div>
            </a-tab-pane>

            <!-- Banner -->
            <a-tab-pane tab="Banner" key="3">
              <div class="tab-form">
                <banner-box v-model="meta.banner.content"></banner-box>

                <image-box v-model="meta.banner.image"
                           :title="'Banner Image'"></image-box>
              </div>
            </a-tab-pane>

            <!-- SEO -->
            <a-tab-pane tab="SEO" key="4">
              <div class="tab-form">
                <SeoBox v-model="meta.seo"></SeoBox>
              </div>
            </a-tab-pane>
          </a-tabs>
        </div>
      </div>

      <!-- section button -->
      <div class="button-section-fixed">
        <div class="form-group text-center">
          <div class="col-sm-12">
            <button @click="save" type="button" class="btn btn-success">
              <i class="fa fa-save"></i> Save
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import store from '@/store'

  // import component
  import SeoBox from '../components/SeoBox'
  import IntroductionBox from '../components/IntroductionBoxForm'
  import ImageBox from '../components/ImagesBox'
  import BannerBox from '../components/BannerBox'

  export default {
    name: 'Setting',
    components: { IntroductionBox, SeoBox, ImageBox, BannerBox },
    data () {
      return {
        meta: {
          seo: [],
          introduction: { content: [], image: '' },
          banner: { content: [], image: '' },
        },
      }
    },
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
        }).catch(() => {})
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
    created () {
      if (this.settings.seo) {
        this.meta.seo = JSON.parse(this.settings.seo)
      }

      if (this.settings.introduction) {
        this.meta.introduction = JSON.parse(this.settings.introduction)
      }

      if (this.settings.banner) {
        this.meta.banner = JSON.parse(this.settings.banner)
      }
    },
    methods: {
      save () {
        this.settings.seo = JSON.stringify(this.meta.seo)

        // update introduction information
        this.settings.introduction = JSON.stringify(this.meta.introduction)

        // update banner information
        this.settings.banner = JSON.stringify(this.meta.banner)

        this.$validator.validateAll().then((result) => {
          if (result) {
            this.$store.dispatch('setting/storeSetting', this.settings).then(() => {
              this.$store.dispatch('setting/savedSetting', true)
              this.$message.success('Save successfully')
              this.$router.push({ name: 'setting' })
            })
          } else {
            this.$message.error('Invalid Form !')
          }
        })
      },
    },

  }
</script>