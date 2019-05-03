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
        <label class="col-sm-2 control-label">Thumbnail</label>
        <div class="col-sm-8">
          <upload-button v-model="meta.thumbnail" :limit="1"></upload-button>
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
  import UploadButton from './UploadButton'

  export default {
    name: 'ClientForm',
    components: { UploadButton },
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
    },
  }
</script>

<style scoped>
  .help-block {
    color: red;
  }
</style>
