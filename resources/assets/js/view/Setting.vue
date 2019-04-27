<template>
  <div class="boxSection">
    <form class="form-horizontal">
      <div class="row">
        <div class="col-xs-12">
          <a-tabs defaultActiveKey="1" tabPosition="left" :animated="false">
            <!-- General Information -->
            <a-tab-pane tab="General Information" key="1">
              <div class="tab-form">
                <div class="box box-widget">
                  <div class="box-header">
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
                      <label for="address" class="col-sm-2 control-label">Address <span
                          class="required">*</span></label>
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

            <!-- About SEO -->
            <a-tab-pane tab="About SEO" key="5">
              <div class="tab-form">
                <SeoBox v-model="meta.about_seo"></SeoBox>
              </div>
            </a-tab-pane>

            <!-- Event SEO -->
            <a-tab-pane tab="Event SEO" key="6">
              <div class="tab-form">
                <SeoBox v-model="meta.event_seo"></SeoBox>
              </div>
            </a-tab-pane>

            <!-- Results SEO -->
            <a-tab-pane tab="Results SEO" key="7">
              <div class="tab-form">
                <SeoBox v-model="meta.results_seo"></SeoBox>
              </div>
            </a-tab-pane>

            <!-- Why SEO -->
            <a-tab-pane tab="Why SEO" key="8">
              <div class="tab-form">
                <SeoBox v-model="meta.why_seo"></SeoBox>
              </div>
            </a-tab-pane>

            <!-- Resources SEO -->
            <a-tab-pane tab="Resources SEO" key="9">
              <div class="tab-form">
                <SeoBox v-model="meta.resource_seo"></SeoBox>
              </div>
            </a-tab-pane>
          </a-tabs>
        </div>
      </div>

      <!-- section button -->
      <PostActionBox @click="save" :actions="actions"></PostActionBox>
    </form>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import store from '@/store'

  // import component
  import SeoBox from '@/components/SeoBox'
  import IntroductionBox from '@/components/IntroductionBoxForm'
  import ImageBox from '@/components/ImagesBox'
  import PostActionBox from '@/components/PostActionBox'
  import BannerBox from '@/components/PostEventForm'

  export default {
    name: 'Setting',
    components: { IntroductionBox, SeoBox, ImageBox, BannerBox, PostActionBox },
    data () {
      return {
        actions: [
          {
            title: 'Save',
            icon: 'fa fa-save',
            type: 'btn-success',
          },
        ],
        meta: {
          seo: [],
          about_seo: [],
          event_seo: [],
          results_seo: [],
          why_seo: [],
          resource_seo: [],
          introduction: { content: [], image: '' },
          banner: { content: [], image: '' },
        },
      }
    },
    computed: {
      ...mapGetters({
        settings: 'setting/settings',
      }),
    },

    beforeRouteLeave (from, to, next) {
      this.$store.dispatch('setting/resetState').then(() => next())
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

      if (this.settings.about_seo) {
        this.meta.about_seo = JSON.parse(this.settings.about_seo)
      }

      if (this.settings.event_seo) {
        this.meta.event_seo = JSON.parse(this.settings.event_seo)
      }

      if (this.settings.event_seo) {
        this.meta.event_seo = JSON.parse(this.settings.event_seo)
      }

      if (this.settings.results_seo) {
        this.meta.results_seo = JSON.parse(this.settings.results_seo)
      }

      if (this.settings.why_seo) {
        this.meta.why_seo = JSON.parse(this.settings.why_seo)
      }

      if (this.settings.resource_seo) {
        this.meta.resource_seo = JSON.parse(this.settings.resource_seo)
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
        this.settings.about_seo = JSON.stringify(this.meta.about_seo)
        this.settings.event_seo = JSON.stringify(this.meta.event_seo)
        this.settings.results_seo = JSON.stringify(this.meta.results_seo)
        this.settings.why_seo = JSON.stringify(this.meta.why_seo)
        this.settings.resource_seo = JSON.stringify(this.meta.resource_seo)

        // update introduction information
        this.settings.introduction = JSON.stringify(this.meta.introduction)

        // update banner information
        this.settings.banner = JSON.stringify(this.meta.banner)

        this.$validator.validateAll().then((result) => {
          if (result) {
            this.$store.dispatch('setting/storeSetting', this.settings).then(() => {
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
