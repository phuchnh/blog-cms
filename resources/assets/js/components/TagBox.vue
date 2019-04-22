<template>
  <div>
    <div class="box box-widget no-border">
      <div class="box-body">
        <form role="form">
          <fieldset>
            <div class="form-group">
              <label for="tags">{{ boxTitle }}</label>
              <a-select
                  id="tags"
                  mode="multiple"
                  v-model="selectedIds"
                  @change="handleChange"
                  :placeholder="boxTitle"
              >
                <a-select-option v-for="(tag, index) of tags" :key="index" :value="tag.id">
                  {{ tag.title }}
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
            <input type="text" name="title" id="title" class="form-control" v-model="defaultTag.title">
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
    name: 'TagBox',
    props: {
      value: {
        type: Array,
        default () {
          return []
        },
      },
      boxTitle: {
        type: String,
        default: 'Tags',
      },
      boxType: {
        type: String,
        default: 'tags',
      },
    },
    data () {
      return {
        selectedIds: [],
        toggleShow: false,
        defaultTag: {
          locale: 'vi',
          title: '',
          parent_id: null,
          type: this.boxType,
        },
      }
    },
    created () {
      store.dispatch('taxonomies/fetchListByType', this.boxType)

      if (this.value.length > 0) {
        this.selectedIds = this.value
      }

    },

    computed: {
      ...mapGetters('taxonomies', ['getListByType']),

      tags () {
        return this.getListByType(this.boxType)
      },
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

      addTag (data) {
        const count = _.filter(this.tags, (value) => value.title === data.title)
        if (count.length === 0) {
          this.loading = true
          this.create(data).then((resp) => {
            this.selectedIds = [...this.selectedIds, resp.id]
            this.loading = false
          })
        }
      },

      onSubmit () {
        this.addTag(this.defaultTag)
      },

      handleChange (value) {
        this.selectedIds = [...value]
      },
    },
  }
</script>

<style scoped>
</style>