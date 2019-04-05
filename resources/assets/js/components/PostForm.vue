<template>
  <div class="box-body">
    <form class="form-horizontal">
      <div class="form-group" :class="{ 'has-error': errors.first('title') }">
        <label for="title" class="col-sm-2 control-label">Title <span class="required">*</span></label>
        <div class="col-sm-8">
          <input v-validate="'required'" class="form-control" id="title" name="title" v-model="post.title"/>
          <div class="help-block" v-if="errors.first('title')">
            <span>{{ errors.first('title') }}</span>
          </div>
        </div>
      </div>
      <div class="form-group" v-if="formAction === 'edit'">
        <label for="slug" class="col-sm-2 control-label">Slug</label>
        <div class="col-sm-8">
          <input class="form-control" id="slug" name="slug" v-model="post.slug"/>
        </div>
      </div>
      <ValidationProvider name="date" rules="required" ref="datepicker" v-slot="{ validate, errors }">
        <div class="form-group" :class="{ 'has-error': errors[0] }">
          <label class="col-sm-2 control-label">Date <span class="required">*</span></label>
          <div class="col-sm-8">
            <a-date-picker
                showTime
                format="YYYY-MM-DD HH:mm:ss"
                placeholder="Select Time"
                v-model="post.date"
            />
            <div class="help-block" v-if="errors">
              <span>{{ errors[0] }}</span>
            </div>
          </div>
        </div>
      </ValidationProvider>
      <div class="form-group" :class="{ 'has-error': errors.first('location') }">
        <label for="location" class="col-sm-2 control-label">Location <span class="required">*</span></label>
        <div class="col-sm-8">
          <input v-validate="'required'" class="form-control" id="location" name="location" v-model="post.location"/>
          <div class="help-block" v-if="errors.first('location')">
            <span>{{ errors.first('location') }}</span>
          </div>
        </div>
      </div>
      <ValidationProvider ref="thumbnail" name="thumbnail" rules="required" v-slot="{ validate, errors }">
        <div class="form-group" :class="{ 'has-error': errors[0] }">
          <label for="thumbnail" class="col-sm-2 control-label">Thumbnail <span class="required">*</span></label>
          <div class="col-sm-8">
            <span class="btn btn-default btn-sm btn-file">
                <i class="fa fa-upload"></i> Upload
                <input type="file" class="form-control"
                       id="thumbnail"
                       name="thumbnail"
                       accept="image/*"
                       @change="onFileChange($event) || validate($event)"/>
            </span>
            <div>
              <img class="img img-thumbnail" width="200" v-if="imgUrl || post.thumbnail"
                   v-bind:src="imgUrl ? imgUrl : post.thumbnail">
            </div>
            <div class="help-block" v-if="errors">
              <span>{{ errors[0] }}</span>
            </div>
          </div>
        </div>
      </ValidationProvider>
      <div class="form-group" :class="{ 'has-error': errors.first('description') }">
        <label for="description" class="col-sm-2 control-label">Description <span class="required">*</span></label>
        <div class="col-sm-8">
          <textarea v-validate="'required'" class="form-control" name="description" id="description"
                    v-model="post.description" rows="3"></textarea>
          <div class="help-block" v-if="errors.first('description')">
            <span>{{ errors.first('description') }}</span>
          </div>
        </div>
      </div>
      <ValidationProvider name="editor" rules="required" ref="editor" v-slot="{ validate, errors }">
        <div class="form-group" :class="{ 'has-error': errors[0] }">
          <label class="col-sm-2 control-label">Content</label>
          <div class="col-sm-8">
            <jodit-vue @input="validate" name="content" v-model="post.content" :config="editorConfigJS"></jodit-vue>
            <div class="help-block" v-if="errors">
              <span>{{ errors[0] }}</span>
            </div>
          </div>
        </div>
      </ValidationProvider>
      <div class="form-group" :class="{ 'has-error': errors.first('publish') }">
        <label for="publish" class="col-sm-2 control-label">Publish <span class="required">*</span></label>
        <div class="col-sm-3">
          <select v-validate="'required'" class="form-control" id="publish" name="publish" v-model="post.publish">
            <option v-for="status in postStatus" :value="status.value">{{status.name}}</option>
          </select>
          <div class="help-block" v-if="errors.first('publish')">
            <span>{{ errors.first('publish') }}</span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-2 col-md-4">
          <button @click="$emit('routeToList')" class="btn btn-default margin-r-5" type="button">Cancel</button>
          <button @click="submit" type="button" class="btn btn-success">{{ formAction === 'create' ? 'Create' :
            'Update'}}
          </button>
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
  import { ValidationProvider } from 'vee-validate';

  export default {
    name: 'PostForm',
    components: { JoditVue, ValidationProvider },
    data () {
      return {
        postStatus: [
          { name: 'Publish', value: 1 },
          { name: 'Draft', value: 0 },
        ],
        imgUrl: null,
        editorConfigJS: {
          uploader: {
            url: 'https://xdsoft.net/jodit/connector/index.php?action=fileUpload',
            queryBuild: function (data) {
              return JSON.stringify(data);
            },
            contentType: function () {
              return 'application/json';
            },
            buildData: function (data) {
              console.log(data)
              return {hello: 'Hello world'}
            }
          },
        },
      }
    },
    created () {
      this.post.content = this.post.content ? this.post.content : ''
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
        console.log(this.saved)
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
        this.$refs.datepicker.validate()
        if (!this.post.thumbnail) {
          this.$refs.thumbnail.validate()
        }
        this.$validator.validateAll().then((result) => {
          if (result && this.$refs.datepicker.flags.valid && this.$refs.editor.flags.valid && this.post.thumbnail) {
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
                console.log(this.saved)
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
