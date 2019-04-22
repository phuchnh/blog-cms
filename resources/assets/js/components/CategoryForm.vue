<template>
  <div class="boxSection">
    <form class="form-horizontal">
      <a-tabs :defaultActiveKey="activeTab" @change="onTabChange">
        <a-tab-pane v-for="trans of translations" :key="trans.locale" :tab="trans.locale | localeName">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">General Informaion</h3>
                </div>
                <div class="box-body">
                  <div class="form-group" :class="{ 'has-error': errors.first('name') }">
                    <label for="name" class="col-sm-2 control-label">Name <span class="required">*</span></label>
                    <div class="col-sm-8">
                      <input v-validate="'required'" class="form-control" id="name" name="name" v-model="trans.title"/>
                      <div class="help-block" v-if="errors.first('name')">
                        <span>{{ errors.first('name') }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group" :class="{ 'has-error': errors.first('slug') }" v-if="formAction === 'edit'">
                    <label for="slug" class="col-sm-2 control-label">Slug <span class="required">*</span></label>
                    <div class="col-sm-8">
                      <input v-validate="'required'" class="form-control" id="slug" name="slug" v-model="trans.slug"/>
                      <div class="help-block" v-if="errors.first('slug')">
                        <span>{{ errors.first('slug') }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Parent category <span class="required">*</span></label>
                    <div class="col-sm-8">
                      <select class="form-control" id="parent" name="parent"
                              v-model="category.parent_id">
                        <option value="" selected>None</option>
                        <option v-for="item in categories" :value="item.id">{{item.title}}</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Type <span class="required">*</span></label>
                    <div class="col-sm-8">
                      <select class="form-control" id="type" name="type"
                              v-model="trans.description">
                        <option v-for="item in categoryType" :value="item.value">{{item.name}}</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Seo Information -->
          <div class="row">
            <div class="col-xs-12">
              <post-meta-form v-model="trans.meta"></post-meta-form>
            </div>
          </div>

          <!-- section button -->
          <div class="form-group">
            <div class="col-md-offset-2 col-md-4">
              <button @click="$emit('routeToList')" class="btn btn-default margin-r-5" type="button">Cancel</button>
              <button @click="submit" type="button" class="btn btn-success">{{ formAction === 'create' ? 'Create' :
                'Update'}}
              </button>
            </div>
          </div>
        </a-tab-pane>
      </a-tabs>
    </form>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import PostMetaForm from './PostMetaForm'

  export default {
    name: 'CategoryForm',
    components: { PostMetaForm },
    computed: {
      ...mapGetters({
        translations: 'taxonomy/getTranslations'
      }),
      category () {
        let data = this.$store.getters['taxonomy/getItem']
        if (this.formAction === 'create') {
          data = {...data, type: 'category'}
        }
        return data
      },
      categories () {
        let data = this.$store.getters['taxonomy/getAll']
        if (this.formAction === 'edit') {
          data = _.reject(data, (item) => {
            return item.id === this.category.id
          })
        }
        return data
      },
      translations () {
        let data = this.$store.getters['taxonomy/getTranslations']
        if (this.formAction === 'create') {
          data = _.map(data, (item) => {
            if (!item.slug) {
              item = _.omit(item, ['slug'])
            }
            return item
          })
        }
        return data
      },
    },
    props: {
      formAction: String,
    },
    data () {
      return {
        type: 'category',
        activeTab: 'vi',
        categoryType: [
          { name: 'Single Page', value: 'single'},
          { name: 'Post', value: 'post'},
        ]
      }
    },
    methods: {
      submit () {
        this.category.type = this.type
        this.category.translations = [...this.translations]
        this.category.translations = _.filter(this.category.translations, (item) => {
          return !!item.title
        })
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
</style>
