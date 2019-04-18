<template>
  <div class="box-body">
    <form class="form-horizontal">
      <div class="form-group" :class="{ 'has-error': errors.first('name') }">
        <label for="name" class="col-sm-2 control-label">Name <span class="required">*</span></label>
        <div class="col-sm-8">
          <input v-validate="'required'" class="form-control" id="name" name="name" v-model="category.name"/>
          <div class="help-block" v-if="errors.first('name')">
            <span>{{ errors.first('name') }}</span>
          </div>
        </div>
      </div>
      <div class="form-group" :class="{ 'has-error': errors.first('parent') }">
        <label for="name" class="col-sm-2 control-label">Parent <span class="required">*</span></label>
        <div class="col-sm-8">
          <select v-validate="'required'" class="form-control" id="parent" name="parent"
                  v-model="category.parent_id">
            <option value="null">None</option>
            <option v-for="item in categories" :value="item.id">{{item.name}}</option>
          </select>
          <div class="help-block" v-if="errors.first('parent')">
            <span>{{ errors.first('parent') }}</span>
          </div>
        </div>
      </div>
      <div class="form-group" :class="{ 'has-error': errors.first('order') }">
        <label for="name" class="col-sm-2 control-label">Order <span class="required">*</span></label>
        <div class="col-sm-8">
          <input v-validate="'required'" class="form-control" id="order" name="order" v-model="category.position"/>
          <div class="help-block" v-if="errors.first('order')">
            <span>{{ errors.first('order') }}</span>
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

  export default {
    name: 'CategoryForm',
    computed: {
      ...mapGetters({
        category: 'taxonomy/getItem',
        categories: 'taxonomy/getAll',
      }),
      categories() {
        let data = this.$store.getters['taxonomy/getAll']
        if (this.formAction === 'edit') {
          data = _.reject(data, (item) => {
            return item.id === this.category.id
          })
        }
        return data
      }
    },
    props: {
      formAction: String,
    },
    data () {
      return {
        type: 'category',
      }
    },
    mounted () {
      this.$store.dispatch('taxonomy/fetchList', {
        type: this.type,
      })
      if (this.formAction === 'edit') {
        this.$store.dispatch('taxonomy/fetchItem', this.$route.params.id)
      }
    },
    methods: {
      submit () {
        this.category.type = this.type
        this.$validator.validateAll().then((result) => {
          if (result) {
            if (this.formAction === 'edit') {
              this.$store.dispatch('taxonomy/update', this.category).then(() => {
                this.$message.success('Update successfully')
                this.$emit('routeToList')
              }).catch((error) => {
                console.log(error)
                this.$message.error('Error')
              })
            } else if (this.formAction === 'create') {
              this.$store.dispatch('taxonomy/create', this.category).then(() => {
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
