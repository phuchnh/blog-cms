<template>
  <div class="boxSection">
    <form role="form" class="form-horizontal">
      <div class="row">
        <div class="col-xs-12 col-md-8">
          <a-tabs :defaultActiveKey="activeTab" :animated="false" @change="onTabChange">
            <a-tab-pane v-for="trans of translations" :key="trans.locale" :tab="trans.locale | localeName">
              <!-- General Information -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">General Informaion</h3>
                </div>
                <div class="box-body">

                  <div class="form-group" :class="{ 'has-error': errors.first('title') }">
                    <label for="title" class="col-sm-2 control-label">Title <span class="required">*</span></label>
                    <div class="col-sm-10">
                      <input v-validate="'required'" class="form-control" id="title" name="title"
                             v-model="trans.title"/>
                      <div class="help-block" v-if="errors.first('title')">
                        <span>{{ errors.first('title') }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group" v-if="formAction === 'edit'">
                    <label for="slug" class="col-sm-2 control-label">Slug</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="slug" name="slug" v-model="trans.slug"/>
                    </div>
                  </div>

                  <div class="form-group" :class="{ 'has-error': errors.first('description') }">
                    <label for="description" class="col-sm-2 control-label">Description <span
                        class="required">*</span></label>
                    <div class="col-sm-10">
                       <textarea v-validate="'required'" class="form-control" name="description" id="description"
                                 v-model="trans.description" rows="3"></textarea>
                      <div class="help-block" v-if="errors.first('description')">
                        <span>{{ errors.first('description') }}</span>
                      </div>
                    </div>
                  </div>

                  <ValidationProvider name="editor" rules="required" ref="editor" v-slot="{ validate, errors }">
                    <div class="form-group" :class="{ 'has-error': errors[0] }">
                      <label class="col-sm-2 control-label">Content <span class="required">*</span></label>
                      <div class="col-sm-10">
                        <Editor :id="trans.locale" v-model="trans.content"/>
                        <div class="help-block" v-if="errors">
                          <span>{{ errors[0] }}</span>
                        </div>
                      </div>
                    </div>
                  </ValidationProvider>

                  <div class="form-group" :class="{ 'has-error': errors.first('publish') }">
                    <label for="publish" class="col-sm-2 control-label">Publish <span class="required">*</span></label>
                    <div class="col-sm-5">
                      <select v-validate="'required'" class="form-control" id="publish" name="publish"
                              v-model="post.publish">
                        <option v-for="status in postStatus" :value="status.value">{{status.name}}</option>
                      </select>
                      <div class="help-block" v-if="errors.first('publish')">
                        <span>{{ errors.first('publish') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Seo Information -->
              <post-meta-form :metaData="post.meta[trans.locale]"
                              @getValue="post.meta[trans.locale] = $event"
                              :locale="trans.locale"
              ></post-meta-form>

              <!-- Event Section -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <div class="box-title">Feature on position</div>
                </div>
                <div class="box-body">
                  <!-- Add Date Picker -->
                  <post-date-form :metaData="post" :formAction="formAction"></post-date-form>

                  <!-- Add Location -->
                  <post-location-form :metaData="post"></post-location-form>
                </div>
              </div>
            </a-tab-pane>
          </a-tabs>
        </div>

        <div class="col-xs-12 col-md-4">
          <post-meta-image :metaData="post" :metaType="'thumbnail'" :title="'thumbnail'"></post-meta-image>

          <post-meta-image :metaData="post" :metaType="'banner'" :title="'banner'"></post-meta-image>

          <post-other-from :metaData="post" :type="type"></post-other-from>

          <div class="box box-default">
            <div class="box-header with-border">
              <div class="box-title">Feature on position</div>
            </div>
            <div class="box-body">
              <post-display :metaData="post" :metaType="'home'" :title="'Show On Homepage'"></post-display>
              <post-display :metaData="post" :metaType="'feature'" :title="'Show On Feature'"></post-display>
            </div>
          </div>

          <!-- Tag Information -->
          <tag-form :tagData.sync="post"></tag-form>
        </div>
      </div>

      <!-- section button -->
      <div class="button-section-fixed">
        <div class="form-group text-center">
          <div class="col-sm-12">
            <button @click="$emit('routeToList')" class="btn btn-default margin-r-5" type="button">
              <i class="fa fa-times"></i> Cancel
            </button>
            <button @click="onSubmit" type="button" class="btn btn-success">
              <i class="fa fa-save"></i> {{ formAction === 'create' ? 'Create' : 'Update'}}
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'
  import Editor from '@/components/Editor.vue'

  // Custom validate
  import { ValidationProvider } from 'vee-validate'

  // load Meta Component
  import PostMetaForm from './PostMetaForm'
  import PostDateForm from './PostDateForm'
  import PostLocationForm from './PostLocationForm'

  import TagForm from './TagForm.vue'

  import PostOtherFrom from './PostOtherForm'
  import PostDisplay from './PostDisplay'
  import PostMetaImage from './PostMetaImageForm'

  export default {
    name: 'PostForm',
    components: {
      TagForm,
      Editor,
      PostLocationForm,
      PostDateForm,
      PostMetaForm,
      PostOtherFrom,
      PostDisplay,
      PostMetaImage,
      ValidationProvider,
    },
    data () {
      return {
        postStatus: [
          { name: 'Publish', value: 1 },
          { name: 'Draft', value: 0 },
        ],
        activeTab: 'vi',
      }
    },
    computed: {
      ...mapGetters('post', ['getItem', 'getTranslations']),

      post () {
        return this.getItem
      },

      translations () {
        return this.getTranslations
      },
    },
    props: {
      type: String,
      formAction: String,
    },
    methods: {
      ...mapActions('post', ['update', 'create']),
      /**
       * Submit form to api
       */
      onSubmit () {
        this.post.translations = [...this.translations]

        this.post.type = this.type

        if (this.formAction === 'create') {
          this.create(this.post).then(() => {
            this.$message.success('Add successfully')
            this.$emit('routeToList')
          })
        } else {
          this.update(this.post).then(() => {
            this.$message.success('Update successfully')
            this.$emit('routeToList')
          })
        }
      },
      /**
       * change tab
       * @param key
       */
      onTabChange (key) {
        this.activeTab = key
      },
    },
  }
</script>

<style scoped>
  .help-block {
    color: red;
  }

  .ant-tabs-nav-scroll {
    background: #fff;
  }
</style>
