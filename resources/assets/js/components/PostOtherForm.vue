<template>
  <div>
    <div class="box box-widget no-border">
      <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>
      </div>
      <div class="box-body">
        <el-select
            v-model="post"
            multiple
            filterable
            remote
            automatic-dropdown
            size="large"
            style="width: 100%"
            placeholder="Select other posts"
            :remote-method="fetchPost"
            @change="handleChange"
            :loading="fetching">
          <el-option
              v-for="item in data"
              :key="item.value.id"
              :label="item.value.title"
              :value="item.value | stringify">
          </el-option>
        </el-select>
      </div>
    </div>
  </div>
</template>

<script>
  import _ from 'lodash'
  import { ApiService } from '../api/api.service'

  export default {
    name: 'PostOtherForm',
    props: {
      value: {
        type: String | Object | Array,
      },
      boxTitle: {
        type: String,
      },
      type: {
        type: String,
      },
    },
    data () {
      this.lastFetchId = 0
      this.fetchPost = _.debounce(this.fetchPost, 500)

      return {
        /**
         *  set default value for select mutiple
         */
        data: [],
        post: this.value ? _.map(this.value, (item) => {
          return JSON.stringify(item)
        }) : [],
        fetching: false,
        relatedPost: [],
      }
    },
    created () {
      this.fetchPost()
    },
    watch: {
      /**
       * update value to parent
       * @param val
       */
      relatedPost: {
        deep: true,
        handler (val) {
          this.$emit('input', val)
        },
      },
    },
    filters: {
      stringify: function (value) {
        return JSON.stringify(value)
      },
    },
    methods: {
      /**
       * load post from api
       * @param value
       */
      fetchPost (value) {
        this.lastFetchId += 1
        this.data = []
        this.fetching = true

        const fetchId = this.lastFetchId

        // set default params for api
        const params = {
          title: value,
          type: this.type,
          with: 'metas',
        }

        // Call api to load post
        ApiService.get('/posts', params).then(res => {
          // receive data from api
          const getData = res.data.data

          // for fetch callback order
          if (fetchId !== this.lastFetchId) {
            return
          }

          // set data for select list
          const data = getData.map(val => ({
            value: {
              id: val.id,
              title: val.title,
              url: `${ window.location.origin }/${ val.slug }`,
              thumbnail: val.metas.thumbnail || null,
            },
          }))

          this.data = data
          this.fetching = false
        })
      },
      /**
       * handle when select value after selected
       * @param value
       */
      handleChange (value) {
        this.relatedPost = _.map(value, (item) => {
          return JSON.parse(item)
        })

        // map to value
        Object.assign(this, {
          post: [...value],
          data: [],
          fetching: false,
        })
      },
    },
  }
</script>
