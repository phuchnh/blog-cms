<template>
  <div>
    <div class="box box-widget no-border">
      <div class="box-body" v-if="hierarchy" key="hierarchy">
        <form role="form">
          <fieldset>
            <div class="form-group">
              <label for="category">{{ title }}</label>
              <select name="name" id="category" class="form-control" v-model="category">
                <option value="0" selected> -- Select One --</option>
                <option v-for="taxonomy of taxonomies" :value="taxonomy.id">{{ taxonomy.translations[0].title }}
                </option>
              </select>
            </div>
          </fieldset>
        </form>
        <hr>
        <form role="form" @submit.prevent="onSubmit">
          <div class="form-group">
            <label for="name">title</label>
            <input type="text" name="name" id="name" class="form-control" v-model="title">
          </div>
          <div class="form-group">
            <label for="parent">parent</label>
            <select name="name" id="parent" class="form-control" v-model="parent_id">
              <option value="0" selected> -- Select One --</option>
              <option v-for="taxonomy of taxonomies" :value="taxonomy.id">{{ taxonomy.translations[0].title }}</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
      <div class="box-body" v-if="!hierarchy" key="hierarchy">
        <div class="form-group">
          <label for="parent">{{ title }}</label>
          <el-select
              v-model="tags"
              multiple
              filterable
              allow-create
              default-first-option
              size="large"
              placeholder="Choose tags for your article"
              style="width: 100%"
              @change="tagsChange"
              no-data-text="No data">
            <el-option
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value">
            </el-option>
          </el-select>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

  import { mapActions, mapGetters, mapMutations } from 'vuex'
  import store from '@/store'
  import * as _ from 'lodash'

  export default {
    name: 'TaxonomyBox',
    props: {
      title: {
        type: String,
        default: 'category',
      },
      taxonomy: {
        type: String,
        default: 'category',
      },
      hierarchy: {
        type: Boolean,
        default: true,
      },
    },
    data () {
      return {
        parent_id: null,
        type: this.taxonomy,
        title: '',
        category: '',
        tags: [],
      }
    },
    beforeMount () {
      store.dispatch('taxonomy/fetchList', {
        type: this.type,
      })
    },
    computed: {
      ...mapGetters('taxonomy', {
        taxonomies: 'getAll',
        options: 'getAll',
      }),
    },
    methods: {
      ...mapActions('taxonomy', ['update', 'create']),
      ...mapMutations('taxonomy', {
        updateList: 'SET_LIST',
      }),

      setData (data) {
        this.create(data).then(
          (data) => {
            const list = _.clone(this.taxonomies)
            list.push(data)
            this.updateList(list)
          },
          (err) => console.log(err),
        )
      },

      onSubmit () {
        this.setData({
          parent_id: this.parent_id,
          name: this.name,
          type: this.type,
        })
      },

      tagsChange (value) {
        this.setData({
          title: value[(value.length - 1)],
          parent_id: this.parent_id,
          type: this.type,
        })
      },
    },
  }
</script>

<style scoped>
</style>