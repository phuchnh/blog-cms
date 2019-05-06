<template>
  <div class="box box-widget">
    <div class="box-body">
      <form class="form-horizontal">
        <div class="form-group" :class="{ 'has-error': errors.first('name') }">
          <label for="name" class="col-sm-2 control-label">Username <span class="required">*</span></label>
          <div class="col-sm-8">
            <input v-validate="'required'" class="form-control" id="name" name="name" v-model="user.name"/>
            <div class="help-block" v-if="errors.first('name')">
              <span>{{ errors.first('name') }}</span>
            </div>
          </div>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.first('email') }">
          <label for="email" class="col-sm-2 control-label">Email <span class="required">*</span></label>
          <div class="col-sm-8">
            <input v-validate="'required'" class="form-control" type="email" id="email" name="email"
                   v-model="user.email"/>
            <div class="help-block" v-if="errors.first('email')">
              <span>{{ errors.first('email') }}</span>
            </div>
          </div>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.first('type') }">
          <label for="type" class="col-sm-2 control-label">Level <span class="required">*</span></label>
          <div class="col-sm-3">
            <select v-validate="'required'" class="form-control" id="type" name="type" v-model="user.type">
              <option v-for="type in userType" :value="type">{{type | capitalize}}</option>
            </select>
            <div class="help-block" v-if="errors.first('type')">
              <span>{{ errors.first('type') }}</span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Avatar</label>
          <div class="col-sm-8">
            <upload-button v-model="meta.avatar" :limit="1"></upload-button>
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
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import UploadButton from './UploadButton'

  export default {
    name: 'UserForm',
    components: { UploadButton },
    computed: {
      ...mapGetters({
        user: 'user/user',
      }),
    },
    props: {
      formAction: String,
    },
    created () {
      this.meta = { ...this.user.meta }
    },
    data () {
      return {
        imgUrl: null,
        meta: {
          avatar: {}
        },
        userType: ['admin', 'editor'],
      }
    },
    methods: {
      submit () {
        this.user.meta = { ...this.meta }
        this.$validator.validateAll().then((result) => {
          if (result) {
            if (this.formAction === 'edit') {
              this.$store.dispatch('user/update', this.user).
                   then(() => this.$store.dispatch('auth/CHECK_AUTH')).
                   then(() => {
                     this.$message.success('Update successfully')
                     this.$emit('routeToList')
                   }).
                   catch((error) => {
                     console.log(error)
                     if (error.response.status === 422) {
                       this.$message.error(error.response.data.error.email[0])
                     } else {
                       this.$message.error('Error')
                     }
                   })
            } else if (this.formAction === 'create') {
              this.$store.dispatch('user/create', this.user).then(() => {
                this.$message.success('Create successfully')
                this.$emit('routeToList')
              }).catch((error) => {
                console.log(error)
                if (error.response.status === 422) {
                  this.$message.error(error.response.data.error.email[0])
                } else {
                  this.$message.error('Error')
                }
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
