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
                  <label for="attendlink">Attend a program Link</label>
                  <input class="form-control" id="attendlink" name="attend_program_link"
                         v-model="data.attend_program_link"/>
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
                <div class="form-group">
                  <label>Website logo</label>
                  <upload-button v-model="data.logo" :limit="1" @uploading="uploadImage"></upload-button>
                </div>
                <div class="form-group">
                  <label>Default avatar</label>
                  <upload-button v-model="data.avatar" :limit="1" @uploading="uploadImage"></upload-button>
                </div>
              </div>
            </div>
          </a-tab-pane>

          <!-- Introduction -->
          <a-tab-pane tab="Introduction" key="2">
            <div class="tab-form">
              <introduction-box v-model="meta.introduction.content"></introduction-box>

              <div class="form-group">
                <label for="introductionVideo">Introduction Video - embed link</label>
                <input class="form-control" id="introductionVideo" name="site_name"
                       v-model="meta.introduction.video_link"/>
              </div>

              <div class="form-group">
                <label>Introduction Image</label>
                <upload-button v-model="meta.introduction.image" :limit="1" @uploading="uploadImage"></upload-button>
              </div>
            </div>
          </a-tab-pane>

          <!-- Banner -->
          <a-tab-pane tab="Banner" key="3">
            <div class="tab-form">
              <banner-box v-model="meta.banner.content"></banner-box>

              <div class="form-group">
                <label>Banner Image</label>
                <upload-button v-model="meta.banner.image" :limit="1" @uploading="uploadImage"></upload-button>
              </div>
            </div>
          </a-tab-pane>

          <!--Thankyou -->
          <a-tab-pane tab="Thankyou" key="4">
            <div class="tab-form">
              <a-tabs defaultActiveKey="1" :animated="false">
                <a-tab-pane tab="Vietnamese" key="1">
                  <div class="tab-form">
                    <Editor id="thankyou_vi" v-model="meta.thankyou.vi"/>
                  </div>
                </a-tab-pane>

                <a-tab-pane tab="English" key="2">
                  <div class="tab-form">
                    <Editor id="thankyou_en" v-model="meta.thankyou.en"/>
                  </div>
                </a-tab-pane>
              </a-tabs>
            </div>
          </a-tab-pane>

          <!-- SEO -->
          <a-tab-pane tab="SEO" key="5">
            <div class="tab-form">
              <SeoBox v-model="meta.seo"></SeoBox>
            </div>
          </a-tab-pane>
        </a-tabs>
      </div>
      <PostActionBox @click="save" :actions="actions" :disable="imageUploading"></PostActionBox>
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
  import UploadButton from '@/components/UploadButton'
  import Editor from '@/components/Editor'

  export default {
    name: 'Setting',
    components: { UploadButton, IntroductionBox, SeoBox, ImageBox, BannerBox, PostActionBox, Editor },
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
          thankyou: {},
          logo: null,
          avatar: null,
        },
        data: {},
        imageUploading: false,
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
      if (this.settings.thankyou) {
        this.meta.thankyou = JSON.parse(this.settings.thankyou)
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
        // update thankyou
        this.settings.thankyou = JSON.stringify(this.meta.thankyou)
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
      uploadImage (event) {
        this.imageUploading = event
      },
    },
  }
</script>
