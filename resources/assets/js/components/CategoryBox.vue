<template>
  <div>
    <div class="box box-widget no-border">
      <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>
      </div>
      <div class="box-body">
        <form role="form">
          <fieldset>
            <div class="form-group">
              <a-select
                  id="categories"
                  mode="multiple"
                  v-model="selectedIds"
                  :loading="loading"
                  @change="handleChange"
                  :placeholder="boxTitle"
              >
                <a-select-option v-for="(category, index) of categories"
                                 :key="index"
                                 :value="category.id"
                >
                  {{ category.title }}
                </a-select-option>
              </a-select>
            </div>
            <div class="form-group">
              <a href="javascript:void(0)" class="form-control-static" @click="toggleShow = !toggleShow">
                + Add new {{ boxTitle }}
              </a>
            </div>
          </fieldset>
        </form>
        <form role="form" @submit.prevent="onSubmit" v-show="toggleShow">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" v-model="defaultCategory.title">
          </div>
          <div class="form-group">
            <label for="parent">Parent</label>
            <select name="name" id="parent" class="form-control" v-model="defaultCategory.parent_id">
              <option value="0" disabled> -- Select One --</option>
              <option v-for="category of categories" :value="category.id">{{ category.title }}</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>

  import { mapActions, mapGetters } from 'vuex'
  import store from '@/store'
  import * as _ from 'lodash'

  export default {
    name: 'CategoryBox',
    props: {
      value: {
        type: Array,
        default () {
          return []
        },
      },
      boxTitle: {
        type: String,
        default: 'category',
      },
      boxType: {
        type: String,
        default: 'category',
      },
    },
    data () {
      return {
        selectedIds: this.value,
        toggleShow: false,
        loading: false,
        defaultCategory: {
          title: '',
          parent_id: null,
          locale: this.locale,
          type: this.boxType,
        },
      }
    },

    created () {
      store.dispatch('taxonomies/fetchListByType', {
        type: this.boxType,
        locale: this.locale
      })
    },

    computed: {
      ...mapGetters('taxonomies', ['getListByType']),
      ...mapGetters('locale', ['getLocale']),

      categories () {
        return this.getListByType(this.boxType)
      },
      locale: {
        get () {
          return this.getLocale
        },
        set (value) {
          this.$store.dispatch('locale/setLocale', value)
        }
      }

    },

    watch: {
      selectedIds (newValue, oldValue) {
        if (newValue !== oldValue) {
          this.$emit('input', newValue)
        }
      },
    },

    methods: {
      ...mapActions('taxonomies', ['create']),

      addCategory (data) {
        const count = _.filter(this.categories, (value) => value.title === data.title)
        if (count.length === 0) {
          this.loading = true
          this.create(data).then((resp) => {
            this.selectedIds = [...this.selectedIds, resp.id]
            this.loading = false
          })
        }

      },

      onSubmit () {
        this.addCategory(this.defaultCategory)
      },

      handleChange (value) {
        this.selectedIds = [...value]
      },
    },
  }
</script>

<style scoped>
</style>
