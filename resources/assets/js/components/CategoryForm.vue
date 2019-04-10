<template>
  <div class="boxSection">
    <form class="form-horizontal">
      <div class="row">
        <div class="col-sm-8">
          <!-- General Information -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">General Informaion</h3>
            </div>
            <div class="box-body">

              <div class="form-group" :class="{ 'has-error': errors.first('title') }">
                <label for="title" class="col-sm-2 control-label">Title <span class="required">*</span></label>
                <div class="col-sm-10">
                  <input v-validate="'required'" class="form-control" id="title" name="title" v-model="post.title"/>
                  <div class="help-block" v-if="errors.first('title')">
                    <span>{{ errors.first('title') }}</span>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="slug" class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-10">
                  <input class="form-control" id="slug" name="slug" v-model="post.slug"/>
                </div>
              </div>

              <ValidationProvider ref="thumbnail" name="thumbnail" rules="required" v-slot="{ validate, errors }">
                <div class="form-group" :class="{ 'has-error': errors[0] }">
                  <label for="thumbnail" class="col-sm-2 control-label">Thumbnail <span
                      class="required">*</span></label>
                  <div class="col-sm-10">
                    <p class="btn btn-default btn-sm btn-file">
                      <i class="fa fa-upload"></i> Upload
                      <input type="file" class="form-control"
                             id="thumbnail"
                             name="thumbnail"
                             accept="image/*"
                             @change="onFileChange($event) || validate($event)"/>
                    </p>
                    <div class="help-block" v-if="errors">
                      <span>{{ errors[0] }}</span>
                    </div>
                  </div>
                </div>

                <div class="form-group" v-if="imgUrl || post.thumbnail">
                  <div class="col-sm-offset-2 col-sm-9">
                    <img class="img img-thumbnail" width="200"
                         v-bind:src="imgUrl ? imgUrl : post.thumbnail">
                  </div>
                </div>
              </ValidationProvider>

              <ValidationProvider name="editor" rules="required" ref="editor" v-slot="{ validate, errors }">
                <div class="form-group" :class="{ 'has-error': errors[0] }">
                  <label class="col-sm-2 control-label">Content <span class="required">*</span></label>
                  <div class="col-sm-10">
                    <jodit-vue name="content" v-model="post.content" :config="editorConfigJS"></jodit-vue>
                    <div class="help-block" v-if="errors">
                      <span>{{ errors[0] }}</span>
                    </div>
                  </div>
                </div>
              </ValidationProvider>

              <div class="form-group" :class="{ 'has-error': errors.first('publish') }">
                <label for="publish" class="col-sm-2 control-label">Publish <span class="required">*</span></label>
                <div class="col-sm-6">
                  <select v-validate="'required'" class="form-control" id="publish" name="publish"
                          v-model="post.publish">
                    <option v-for="status in postStatus" :value="status.value">{{status.name}}</option>
                  </select>
                  <div class="help-block" v-if="errors.first('publish')">
                    <span>{{ errors.first('publish') }}</span>
                  </div>
                </div>
              </div>

              <div class="form-group" :class="{ 'has-error': errors.first('type') }">
                <label for="type" class="col-sm-2 control-label">Type <span class="required">*</span></label>
                <div class="col-sm-6">
                  <select v-validate="'required'" class="form-control" id="type" name="metaType"
                          v-model="post.meta.type">
                    <option v-for="metaType in typeStatus" :value="metaType.value">{{metaType.name}}</option>
                  </select>
                  <div class="help-block" v-if="errors.first('metaType')">
                    <span>{{ errors.first('metaType') }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-4">

        </div>
      </div>

      <div class="row">
        <div class="col-sm-8">
          <!-- Seo Information -->
          <post-meta-form :metaData.sync="post"></post-meta-form>
        </div>
      </div>

      <!-- section button -->
      <div class="button-section-fixed">
        <div class="form-group text-center">
          <div class="col-sm-12">
            <button @click="$emit('routeToList')" class="btn btn-default margin-r-5" type="button">
              <i class="fa fa-times"></i> Cancel
            </button>
            <button @click="submit" type="button" class="btn btn-success">
              <i class="fa fa-save"></i> {{ formAction === 'create' ? 'Create' : 'Update'}}
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  // Jodit
  import JoditVue from 'jodit-vue'
  import 'jodit/build/jodit.min.css'

  // Custom validate
  import { ValidationProvider } from 'vee-validate'

  // load Meta Component
  import PostMetaForm from './PostMetaForm'

  import PostDisplay from './PostDisplay'

  export default {
    name: 'PostForm',
    components: {
      JoditVue,
      PostMetaForm,
      PostDisplay,
      ValidationProvider,
    },
    data () {
      return {
        postStatus: [
          { name: 'Publish', value: 1 },
          { name: 'Draft', value: 0 },
        ],
        typeStatus: [
          { name: 'Custom Page', value: 1 },
          { name: 'Single Page', value: 0 },
        ],
        imgUrl: null,
        editorConfigJS: {
          uploader: {
            url: 'https://xdsoft.net/jodit/connector/index.php?action=fileUpload',
            queryBuild: function (data) {
              return JSON.stringify(data)
            },
            contentType: function () {
              return 'application/json'
            },
            buildData: function (data) {
              return { hello: 'Hello world' }
            },
          },
        },
      }
    },
    created () {
      this.post.publish = this.post.publish || 1
      this.post.content = this.post.content ? this.post.content : ''
      this.post.meta = this.post.meta ? this.post.meta : {}
      this.post.meta.type = this.post.meta.type || 0
    },
    computed: {
      ...mapGetters({
        post: 'post/post',
        saved: 'post/saved',
      }),
    },
    props: {
      type: String,
      formAction: String,
    },
    mounted () {
      if (this.formAction === 'edit') {
        this.$store.dispatch('post/getPost', this.$route.params.id)
        this.$store.dispatch('post/savedPost', true)
      }
    },
    watch: {
      post: {
        deep: true,
        handler (val, oldVal) {
          if (val.id === oldVal.id && val !== oldVal) {
            this.$store.dispatch('post/savedPost', false)
          }
        },
      },
    },
    methods: {
      submit () {
        this.post.type = this.type
        this.$refs.editor.validate()
        if (!this.post.thumbnail) {
          this.$refs.thumbnail.validate()
        }
        this.$refs.thumbnail.flags.valid = true
        this.$validator.validateAll().then((result) => {
          if (result && this.$refs.editor.flags.valid && this.$refs.thumbnail.flags.valid) {
            if (this.formAction === 'edit') {
              this.$store.dispatch('post/updatePost', this.post).then(() => {
                this.$store.dispatch('post/savedPost', true)
                console.log(this.saved)
                this.$message.success('Update successfully')
                this.$emit('routeToList')
              }).catch((error) => {
                console.log(error)
                this.$message.error('Error')
              })
            } else if (this.formAction === 'create') {
              this.$store.dispatch('post/createPost', this.post).then(() => {
                this.$store.dispatch('post/savedPost', true)
                this.$message.success('Create successfully')
                this.$emit('routeToList')
              }).catch((error) => {
                console.log(error)
                this.$message.error('Error')
              })
            }
          } else {
            this.$message.error('Invalid Form !')
          }
        })
      },
      onFileChange (event) {
        const file = event.target.files[0]
        const temp = {
          name: file.name,
        }
        const reader = new FileReader()
        reader.readAsDataURL(file)
        reader.onloadend = () => {
          this.imgUrl = reader.result
          temp.body = reader.result.split(',')[1]
        }
        this.post.thumbnail = temp
      },
    },
  }
</script>

<style scoped>
  .help-block {
    color: red;
  }
</style>
