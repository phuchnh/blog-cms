<template>
  <div class="boxNavigation">
    <form class="form-horizontal">
      <div class="row">
        <div class="col-xs-12">
          <a-tabs defaultActiveKey="1" :animated="false">
            <!-- About Section -->
            <a-tab-pane tab="About" key="1">
              <a-tabs defaultActiveKey="1" tabPosition="left" :animated="false">
                <!-- Story -->
                <a-tab-pane tab="Story" key="1">
                  <image-box v-model="meta.story.banner"
                             :box-title="'Banner'"></image-box>

                  <content-box :box-title="'Content'" v-model="meta.story.content"></content-box>

                  <SeoBox v-model="meta.story.seo"></SeoBox>
                </a-tab-pane>

                <!-- Expert -->
                <a-tab-pane tab="Expert" key="2">
                  <image-box v-model="meta.expert.banner"
                             :box-title="'Banner'"></image-box>

                  <content-box :box-title="'Content'" v-model="meta.expert.content"></content-box>

                  <SeoBox v-model="meta.expert.seo"></SeoBox>
                </a-tab-pane>

                <!-- Press -->
                <a-tab-pane tab="Press" key="3">
                  <image-box v-model="meta.press.banner"
                             :box-title="'Banner'"></image-box>

                  <content-box :box-title="'Content'" v-model="meta.press.content"></content-box>

                  <SeoBox v-model="meta.press.seo"></SeoBox>
                </a-tab-pane>

                <!-- Contact -->
                <a-tab-pane tab="Contact" key="4">
                  <image-box v-model="meta.contact.banner"
                             :box-title="'Banner'"></image-box>

                  <content-box :box-title="'Content'" v-model="meta.contact.content"></content-box>

                  <SeoBox v-model="meta.contact.seo"></SeoBox>
                </a-tab-pane>
              </a-tabs>
            </a-tab-pane>

            <!-- Event -->
            <a-tab-pane tab="Event" key="2">
              <a-tabs defaultActiveKey="1" tabPosition="left" :animated="false">
                <!-- Event & Program -->
                <a-tab-pane tab="Event & Program" key="1">
                  <image-box v-model="meta.eventprogram.banner"
                             :box-title="'Banner'"></image-box>

                  <SeoBox v-model="meta.eventprogram.seo"></SeoBox>
                </a-tab-pane>

                <!-- Event -->
                <a-tab-pane tab="Event" key="2">
                  <image-box v-model="meta.event.thumbnail"
                             :box-title="'Thumbnail'"></image-box>

                  <image-box v-model="meta.event.banner"
                             :box-title="'Banner'"></image-box>

                  <content-box :box-title="'Content'" v-model="meta.event.content"></content-box>

                  <SeoBox v-model="meta.event.seo"></SeoBox>
                </a-tab-pane>

                <!-- Program -->
                <a-tab-pane tab="Program" key="3">
                  <image-box v-model="meta.program.thumbnail"
                             :box-title="'Thumbnail'"></image-box>

                  <image-box v-model="meta.program.banner"
                             :box-title="'Banner'"></image-box>

                  <content-box :box-title="'Content'" v-model="meta.program.content"></content-box>

                  <SeoBox v-model="meta.program.seo"></SeoBox>
                </a-tab-pane>
              </a-tabs>
            </a-tab-pane>

            <!-- Results -->
            <a-tab-pane tab="Results" key="3">
              <a-tabs defaultActiveKey="1" tabPosition="left" :animated="false">
                <!-- Approach -->
                <a-tab-pane tab="Approach" key="1">
                  <image-box v-model="meta.approach.banner"
                             :box-title="'Banner'"></image-box>

                  <content-box :box-title="'Content'" v-model="meta.approach.content"></content-box>

                  <SeoBox v-model="meta.approach.seo"></SeoBox>
                </a-tab-pane>

                <!-- Expertise -->
                <a-tab-pane tab="Expertise" key="2">
                  <image-box v-model="meta.expertise.banner"
                             :box-title="'Banner'"></image-box>

                  <content-box :box-title="'Content'" v-model="meta.expertise.content"></content-box>

                  <SeoBox v-model="meta.expertise.seo"></SeoBox>
                </a-tab-pane>

                <!-- Testimonial -->
                <a-tab-pane tab="Testimonial" key="3">
                  <image-box v-model="meta.testimonial.banner"
                             :box-title="'Banner'"></image-box>

                  <content-box :box-title="'Content'" v-model="meta.testimonial.content"></content-box>

                  <SeoBox v-model="meta.testimonial.seo"></SeoBox>
                </a-tab-pane>
              </a-tabs>
            </a-tab-pane>

            <!-- Why mind fullness -->
            <a-tab-pane tab="Why Mindfullness" key="4">
              <a-tabs defaultActiveKey="1" tabPosition="left" :animated="false">
                <!-- Benefits -->
                <a-tab-pane tab="Benefits" key="1">
                  <image-box v-model="meta.benefits.banner"
                             :box-title="'Banner'"></image-box>

                  <content-box :box-title="'Content'" v-model="meta.benefits.content"></content-box>

                  <SeoBox v-model="meta.benefits.seo"></SeoBox>
                </a-tab-pane>

                <!-- Practise -->
                <a-tab-pane tab="Practise" key="2">
                  <image-box v-model="meta.practise.banner"
                             :box-title="'Banner'"></image-box>

                  <content-box :box-title="'Content'" v-model="meta.practise.content"></content-box>

                  <SeoBox v-model="meta.practise.seo"></SeoBox>
                </a-tab-pane>

                <!-- Faq -->
                <a-tab-pane tab="Faq" key="3">
                  <image-box v-model="meta.faq.banner"
                             :box-title="'Banner'"></image-box>

                  <content-box :box-title="'Content'" v-model="meta.faq.content"></content-box>

                  <SeoBox v-model="meta.faq.seo"></SeoBox>
                </a-tab-pane>
              </a-tabs>
            </a-tab-pane>

            <!-- Resources -->
            <a-tab-pane tab="Resources" key="5">
              <a-tabs defaultActiveKey="1" tabPosition="left" :animated="false">
                <!-- Blog -->
                <a-tab-pane tab="Blog" key="1">
                  <image-box v-model="meta.blog.banner"
                             :box-title="'Banner'"></image-box>

                  <SeoBox v-model="meta.blog.seo"></SeoBox>
                </a-tab-pane>

                <!-- Guide -->
                <a-tab-pane tab="Guide" key="2">
                  <image-box v-model="meta.guide.banner"
                             :box-title="'Banner'"></image-box>

                  <SeoBox v-model="meta.guide.seo"></SeoBox>
                </a-tab-pane>

                <!-- Practice -->
                <a-tab-pane tab="Practice" key="3">
                  <image-box v-model="meta.practice.banner"
                             :box-title="'Banner'"></image-box>

                  <SeoBox v-model="meta.practice.seo"></SeoBox>
                </a-tab-pane>
              </a-tabs>
            </a-tab-pane>
          </a-tabs>
        </div>

        <!-- section button -->
        <PostActionBox @click="save" :actions="actions"></PostActionBox>
      </div>
    </form>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import store from '@/store'

  // import component
  import SeoBox from '@/components/SeoBox'
  import ImageBox from '@/components/ImagesBox'
  import ContentBox from '@/components/ContentBox'
  import PostActionBox from '@/components/PostActionBox'
  import BannerBox from '@/components/PostEventForm'

  export default {
    name: 'Navigation',
    components: { SeoBox, ImageBox, BannerBox, PostActionBox, ContentBox },
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
          expert: [],
          story: [],
          press: [],
          contact: [],

          eventprogram: [],
          event: [],
          program: [],

          approach: [],
          expertise: [],
          testimonial: [],

          benefits: [],
          practise: [],
          faq: [],

          blog: [],
          guide: [],
          practice: [],
        },
      }
    },
    computed: {
      ...mapGetters({
        settings: 'setting/list',
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
      // About Section
      if (this.settings.expert) {
        this.meta.expert = JSON.parse(this.settings.expert)
      }

      if (this.settings.story) {
        this.meta.story = JSON.parse(this.settings.story)
      }

      if (this.settings.press) {
        this.meta.press = JSON.parse(this.settings.press)
      }

      if (this.settings.contact) {
        this.meta.contact = JSON.parse(this.settings.contact)
      }

      // Event Section
      if (this.settings.eventprogram) {
        this.meta.eventprogram = JSON.parse(this.settings.eventprogram)
      }

      if (this.settings.event) {
        this.meta.event = JSON.parse(this.settings.event)
      }

      if (this.settings.program) {
        this.meta.program = JSON.parse(this.settings.program)
      }

      // Results Section
      if (this.settings.approach) {
        this.meta.approach = JSON.parse(this.settings.approach)
      }

      if (this.settings.expertise) {
        this.meta.expertise = JSON.parse(this.settings.expertise)
      }

      if (this.settings.testimonial) {
        this.meta.testimonial = JSON.parse(this.settings.testimonial)
      }

      // Why Mind Fullness
      if (this.settings.benefits) {
        this.meta.benefits = JSON.parse(this.settings.benefits)
      }

      if (this.settings.practise) {
        this.meta.practise = JSON.parse(this.settings.practise)
      }

      if (this.settings.faq) {
        this.meta.faq = JSON.parse(this.settings.faq)
      }

      // Resource section
      if (this.settings.blog) {
        this.meta.blog = JSON.parse(this.settings.blog)
      }

      if (this.settings.guide) {
        this.meta.guide = JSON.parse(this.settings.guide)
      }

      if (this.settings.practice) {
        this.meta.practice = JSON.parse(this.settings.practice)
      }
    },

    methods: {
      save () {
        // About section
        this.settings.story = JSON.stringify(Object.assign({}, this.meta.story))
        this.settings.expert = JSON.stringify(Object.assign({}, this.meta.expert))
        this.settings.press = JSON.stringify(Object.assign({}, this.meta.press))
        this.settings.contact = JSON.stringify(Object.assign({}, this.meta.contact))

        // Event section
        this.settings.eventprogram = JSON.stringify(Object.assign({}, this.meta.eventprogram))
        this.settings.event = JSON.stringify(Object.assign({}, this.meta.event))
        this.settings.program = JSON.stringify(Object.assign({}, this.meta.program))

        // Results section
        this.settings.approach = JSON.stringify(Object.assign({}, this.meta.approach))
        this.settings.expertise = JSON.stringify(Object.assign({}, this.meta.expertise))
        this.settings.testimonial = JSON.stringify(Object.assign({}, this.meta.testimonial))

        // Why mind fullness section
        this.settings.benefits = JSON.stringify(Object.assign({}, this.meta.benefits))
        this.settings.practise = JSON.stringify(Object.assign({}, this.meta.practise))
        this.settings.faq = JSON.stringify(Object.assign({}, this.meta.faq))

        // Resource section
        this.settings.blog = JSON.stringify(Object.assign({}, this.meta.blog))
        this.settings.guide = JSON.stringify(Object.assign({}, this.meta.guide))
        this.settings.practice = JSON.stringify(Object.assign({}, this.meta.practice))

        this.$validator.validateAll().then((result) => {
          if (result) {
            this.$store.dispatch('setting/storeSetting', this.settings).then(() => {
              this.$message.success('Save successfully')
              this.$router.push({ name: 'navigation' })
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
