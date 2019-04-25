<template>
  <div class="box-body">
    <form class="form-horizontal">
      <div class="form-group" :class="{ 'has-error': errors.first('name') }">
        <label for="name" class="col-sm-2 control-label">Name <span class="required">*</span></label>
        <div class="col-sm-8">
          <input v-validate="'required'" class="form-control" id="name" name="name" v-model="client.name"/>
          <div class="help-block" v-if="errors.first('name')">
            <span>{{ errors.first('name') }}</span>
          </div>
        </div>
      </div>
      <div class="form-group" :class="{ 'has-error': errors.first('url') }">
        <label for="name" class="col-sm-2 control-label">Url <span class="required">*</span></label>
        <div class="col-sm-8">
          <input v-validate="'required'" class="form-control" id="url" name="url" v-model="client.url"/>
          <div class="help-block" v-if="errors.first('url')">
            <span>{{ errors.first('url') }}</span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="thumbnail" class="col-sm-2 control-label">Thumbnail</label>
        <div class="col-sm-8">
                    <span class="btn btn-default btn-sm btn-file">
                        <i class="fa fa-upload"></i> Upload
                        <input type="file" class="form-control"
                               id="thumbnail"
                               name="thumbnail"
                               accept="image/*"
                               @change="onFileChange($event)"/>
                    </span>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
          <img class="img img-thumbnail" width="200" v-if="imgUrl || meta.thumbnail"
               v-bind:src="imgUrl ? imgUrl : meta.thumbnail">
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

  export default {
    name: 'ClientForm',
    computed: {
      ...mapGetters({
        client: 'client/client',
      }),
    },
    props: {
      formAction: String,
    },
    created () {
      this.meta = {...this.client.meta}
    },
    data () {
      return {
        imgUrl: null,
        meta: {}
      }
    },
    methods: {
      submit () {
        this.client.meta = {...this.meta}
        this.$validator.validateAll().then((result) => {
          if (result) {
            if (this.formAction === 'edit') {
              this.$store.dispatch('client/update', this.client).then(() => {
                this.$message.success('Update successfully')
                this.$emit('routeToList')
              }).catch((error) => {
                console.log(error)
                this.$message.error('Error')
              })
            } else if (this.formAction === 'create') {
              this.$store.dispatch('client/create', this.client).then(() => {
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
        const fileInput = file
        this.meta.thumbnail = new FormData()
        this.meta.thumbnail.append('files[0]', fileInput)
      },
    },
  }
</script>

<style scoped>
  .help-block {
    color: red;
  }
</style>
