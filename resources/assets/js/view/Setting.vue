<template>
  <div>
    <div class="box box-widget">
      <div class="box-body">
        <a-tabs defaultActiveKey="1" tabPosition="left" :animated="false">

          <!-- General Information -->
          <a-tab-pane tab="General Information" key="1">
            <div class="box box-widget">
              <div class="box-body">
                <div class="form-group">
                  <label for="site-name">Site name</label>
                  <input class="form-control" id="site-name" name="site_name"
                         v-model="data.site_name"/>
                </div>

                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input class="form-control" id="phone" name="phone"
                         v-model="data.phone"/>
                </div>

                <div class="form-group">
                  <label for="address">Address</label>
                  <input class="form-control" id="address" name="address"
                         v-model="data.address"/>
                </div>

                <div class="form-group">
                  <label for="facebook">Facebook</label>
                  <input class="form-control" id="facebook" name="facebook"
                         v-model="data.facebook"/>
                </div>

                <div class="form-group">
                  <label for="instagram">Instagram</label>
                  <input class="form-control" id="instagram" name="instagram"
                         v-model="data.instagram"/>
                </div>

                <div class="form-group" :class="{ 'has-error': errors.first('email') }">
                  <label for="email">Email</label>
                  <input v-validate="'email'" class="form-control" id="email" name="email"
                         v-model="data.email"/>
                  <div class="help-block" v-if="errors.first('email')">
                    <span>{{ errors.first('email') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="linkedin">Linkedin</label>
                  <input class="form-control" id="linkedin" name="linkedin"
                         v-model="data.linkedin"/>
                </div>

                <div class="form-group">
                  <label for="copyright">Copyright</label>
                  <input class="form-control" id="copyright" name="copyright"
                         v-model="data.copyright"/>
                </div>
              </div>
              <image-box v-model="data.logo" :title="'Website Logo'" :limit="1"></image-box>
              <image-box v-model="data.avatar" :title="'Default avatar'" :limit="1"></image-box>
            </div>
          </a-tab-pane>

          <!-- Introduction -->
          <a-tab-pane tab="Introduction" key="2">
            <div class="tab-form">
              <introduction-box v-model="meta.introduction.content"></introduction-box>

              <image-box v-model="meta.introduction.image" :title="'Introduction Image'"></image-box>
            </div>
          </a-tab-pane>

          <!-- Banner -->
          <a-tab-pane tab="Banner" key="3">
            <div class="tab-form">
              <banner-box v-model="meta.banner.content"></banner-box>

              <image-box v-model="meta.banner.image" :title="'Banner Image'"></image-box>
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
      <PostActionBox @click="save" :actions="actions"></PostActionBox>
    </div>
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
  import BannerBox from '@/components/BannerBox'

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
          introduction: { content: [], image: '' },
          banner: { content: [], image: '' },
          logo: null,
          avatar: null,
        },
        data: {},
      }
    },
    computed: {
      settings: {
        get () {
          return this.$store.getters['setting/list']
        },
        set (value) {
          this.$store.commit('setting/setList', value)
        },
      },
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
      this.data = { ...this.settings }
    },
    methods: {
      save () {
        this.settings = this.data
        this.settings.seo = JSON.stringify(this.meta.seo)
        // update introduction information
        this.settings.introduction = JSON.stringify(this.meta.introduction)
        // update banner information
        this.settings.banner = JSON.stringify(this.meta.banner)
        this.$validator.validateAll().then((result) => {
          if (result) {
            this.$store.dispatch('setting/storeSetting', this.settings).then(() => {
              this.$message.success('Save successfully')
              this.$router.push({ name: 'setting' })
            }).catch((err) => {
              console.log(err)
              this.$message.error('Error')
            })
          } else {
            this.$message.error('Invalid Form !')
          }
        })
      },
    },
  }
</script>
