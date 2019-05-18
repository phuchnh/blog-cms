<template>
  <div class="col-sm-6">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Recent Posts</h3>

      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <el-table
            :data="lists"
            v-loading="loading"
            border
            size="small"
            empty-text="No data"
            height="280"
        >
          <el-table-column prop="id" label="Id" min-width="30"/>
          <el-table-column prop="title" label="Title">
            <template slot-scope="scope" class="text-nowrap">
              <a @click="goToDetail(scope.row.id, scope.row.type)">{{ scope.row.title }}</a>
            </template>
          </el-table-column>
          <el-table-column prop="type" label="Type">
            <template slot-scope="scope">
              {{ scope.row.type | transformType }}
            </template>
          </el-table-column>
          <el-table-column prop="publish" label="Status">
            <template slot-scope="scope">
              {{ scope.row.publish ? 'Publish' : 'Draft' }}
            </template>
          </el-table-column>
          <el-table-column prop="created_at" label="Created at"/>
        </el-table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</template>

<script>
  import store from '@/store'
  import * as _ from 'lodash'
  import router from '@/router'
  import { mapGetters, mapActions } from 'vuex'

  export default {
    name: 'RecentPost',
    computed: {
      ...mapGetters('faq', ['getLoading', 'getRecentPost']),
      loading () {
        return this.getLoading
      },
      lists () {
        return this.getRecentPost
      },
    },
    filters: {
      transformType: function (value) {
        return _.startCase(_.split(value, '_')[1])
      },
    },
    created () {
      store.dispatch('faq/fetchRecentPost')
    },
    methods: {
      goToDetail (id, postType) {
        const routeByPostType = router.options.routes[0].children.find(value => {
          return value.props && value.props.postType === postType
        })
        this.$router.push({ name: routeByPostType.props.redirectToDetail, params: { id: id } })
      },
    },
  }
</script>

<style scoped>
</style>
