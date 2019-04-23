<template>
  <div class="box">
    <div class="box-header">
      <div class="box-header with-border">
        <h3 class="box-title">Custom Related Post</h3>
      </div>
    </div>

    <div class="box-body">
      <div class="col-sm-12">
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
              :key="item.value"
              :label="item.text"
              :value="item.value">
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
      type: {
        type: String,
      },
    },
    data () {
      this.lastFetchId = 0
      this.fetchPost = _.debounce(this.fetchPost, 500)

      return {
        item: this.value ? this.value : {},

        /**
         *  set default value for select mutiple
         */
        data: [],
        post: this.value.others ? _.toArray(JSON.parse(this.value.others)) : [],
        fetching: false,
      }
    },
    watch: {
      /**
       * update value to parent
       * @param val
       */
      item: {
        deep: true,
        handler (val) {
          this.$emit('input', val)
        },
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
          page: 1,
          perPage: 10,
          type: this.type,
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
            text: `${ val.title }`,
            value: val.id.toString(),
            key: val.id,
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
        this.item = {...this.item, others: JSON.stringify({ ...value })}

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
