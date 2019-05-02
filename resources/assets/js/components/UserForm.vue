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
          <label for="avatar" class="col-sm-2 control-label">Avatar</label>
          <div class="col-sm-8">
                    <span class="btn btn-default btn-sm btn-file">
                        <i class="fa fa-upload"></i> Upload
                        <input type="file" class="form-control"
                               id="avatar"
                               name="avatar"
                               accept="image/*"
                               @change="onFileChange($event)"/>
                    </span>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-8 col-sm-offset-2">
            <img class="img img-thumbnail" width="200" v-if="imgUrl || meta.avatar"
                 v-bind:src="imgUrl ? imgUrl : meta.avatar">
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

  export default {
    name: 'UserForm',
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
        meta: {},
        userType: ['admin', 'editor'],
      }
    },
    methods: {
      submit () {
        this.user.meta = { ...this.meta }
        this.$validator.validateAll().then((result) => {
          if (result) {
            if (this.formAction === 'edit') {
              this.$store.dispatch('user/update', this.user)
                   .then(() => this.$store.dispatch('auth/CHECK_AUTH'))
                   .then(() => {
                     this.$message.success('Update successfully')
                     this.$emit('routeToList')
                   }).
                   catch((error) => {
                     console.log(error)
                     this.$message.error('Error')
                   })
            } else if (this.formAction === 'create') {
              this.$store.dispatch('user/create', this.user).then(() => {
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
        this.meta.avatar = new FormData()
        this.meta.avatar.append('files[0]', fileInput)
      },
    },
  }
</script>

<style scoped>
  .help-block {
    color: red;
  }
</style>
