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
              v-for="item in getListsOther"
              :key="item.id"
              :label="item.title"
              :value="item | stringify">
          </el-option>
        </el-select>
      </div>
    </div>
  </div>
</template>

<script>
  import _ from 'lodash'
  import { mapGetters } from 'vuex'

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
      return {
        /**
         *  set default value for select multiple
         */
        dataOthers: this.getListsOther,
        post: this.value ? _.map(this.value, (item) => {
          return JSON.stringify(item)
        }) : [],
        fetching: false,
        relatedPost: [],
      }
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

      getListsOther (val) {
        this.dataOthers = val
      },
    },
    filters: {
      stringify: function (value) {
        return JSON.stringify(value)
      },
    },
    computed: {
      ...mapGetters('faq', ['getListsOther']),
    },
    methods: {
      /**
       * load post from api
       * @param value
       */
      async fetchPost (value) {
        this.lastFetchId += 1
        this.fetching = true

        const fetchId = this.lastFetchId

        // set default params for api
        const params = {
          title: value,
          type: this.type,
          with: 'metas,thumbnail',
        }

        await this.$store.dispatch('faq/fetchListOther', params)

        // this.post =
        this.fetching = false
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
          fetching: false,
        })
      },
    },
  }
</script>
