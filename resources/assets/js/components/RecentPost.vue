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
            height="240"
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
      <div class="box-footer text-center">
        <el-pagination
            layout="prev, pager, next"
            background
            :page-size="queryParams.perPage"
            :total="total"
            :current-page="queryParams.page"
            @current-change="handleCurrentChange"
        >
        </el-pagination>
      </div>
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
      ...mapGetters('faq', ['getLoading', 'getLists', 'getTotal', 'getQueryParams']),
      loading () {
        return this.getLoading
      },
      lists () {
        return this.getLists
      },
      total () {
        return this.getTotal
      },
      queryParams () {
        return this.getQueryParams
      },
    },
    filters: {
      transformType: function (value) {
        return _.startCase(_.split(value, '_')[1])
      },
    },
    created () {
      Promise.all([
        store.dispatch('faq/setPostType', ''),
        store.dispatch('faq/setQueryParams', {
          sort: 'created_at',
          direction: 'desc',
          page: 1,
          perPage: 5,
          only: ['id', 'title', 'publish', 'type', 'created_at'].join(','),
          locale: 'vi',
          limit: 10,
        }),
      ]).then(() => {
        store.dispatch('faq/fetchList')
      })
    },
    methods: {
      ...mapActions('faq', ['fetchList']),

      goToDetail (id, postType) {
        const routeByPostType = router.options.routes[0].children.find(value => {
          return value.props && value.props.postType === postType
        })
        this.$router.push({ name: routeByPostType.props.redirectToDetail, params: { id: id } })
      },

      handleCurrentChange (currentPage) {
        this.getData({
          ...this.queryParams,
          page: currentPage,
        })
      },

      handleSortChange ({ prop, order }) {
        const direction = { ascending: 'desc', descending: 'asc' }
        this.getData({
          ...this.queryParams,
          sort: prop,
          direction: direction[order],
        })
      },

      getData (queryParams) {
        queryParams = {
          ...queryParams,
          with: 'taxonomies',
        }
        return this.fetchList(queryParams)
      },
    },
  }
</script>

<style scoped>
</style>
