<template>
  <div class="box box-success">
    <div class="box-header">
      <div class="box-header with-border">
        <h3 for="other_post" class="box-title">Other Post</h3>
      </div>
    </div>

    <div class="box-body">
      <div class="col-sm-12">
        <a-select
            id="other_post"
            mode="multiple"
            labelInValue
            :value="value"
            placeholder="Select other posts"
            style="width: 100%"
            :filterOption="false"
            @search="fetchPost"
            @change="handleChange"
            :notFoundContent="fetching ? undefined : null"
        >
          <a-spin v-if="fetching" slot="notFoundContent" size="small"/>

          <a-select-option v-for="d in data" :key="d.value">{{d.text}}</a-select-option>
        </a-select>
      </div>
    </div>
  </div>
</template>

<script>
  import _ from 'lodash'
  import { ApiService } from '../api/api.service'

  export default {
    name: 'PostOtherForm',
    props: ['metaData', 'type'],
    data () {
      this.lastFetchId = 0
      this.fetchPost = _.debounce(this.fetchPost, 500)

      return {
        item: this.metaData.meta ? this.metaData.meta : {},

        /**
         *  set default value for select mutiple
         */
        data: [],
        value: [],
        fetching: false,
      }
    },
    watch: {
      /**
       * update value to parent
       * @param val
       */
      item (val) {
        // convert Array to String
        if (typeof val.others !== 'undefined') {
          val.others = val.others.map(val => {
            return val['key']
          }).join()
        }

        this.metaData.meta = val

        this.$emit('item', this.metaData)
      },
      /**
       * set props data
       * @param val
       */
      metaData (val) {
        this.item = val.meta ? val.meta : {}
        this.value = val.meta && val.meta.others ? val.meta.others : []
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
        // set Props value
        this.item.others = value.map(val => {
          return val['key']
        }).join()

        // map to value
        Object.assign(this, {
          value,
          data: [],
          fetching: false,
        })
      },
    },
  }
</script>

<style scoped>

</style>
