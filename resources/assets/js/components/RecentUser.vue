<template>
  <div class="col-sm-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Recent Users</h3>

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
          <el-table-column prop="name" label="Name">
            <template slot-scope="scope">
              <a @click="goToDetail(scope.row.id)">{{ scope.row.name }}</a>
            </template>
          </el-table-column>
          <el-table-column prop="email" label="Email"/>
          <el-table-column
              label="Type"
              prop="type">
            <template slot-scope="scope">
              {{ scope.row.type | capitalize }}
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
    name: 'RecentUser',
    computed: {
      ...mapGetters('user', ['users', 'pagination', 'getQueryParams']),
      lists () {
        return this.users
      },
      total () {
        return this.pagination.total
      },
      queryParams () {
        return this.getQueryParams
      },
    },
    data () {
      return {
        loading: true
      }
    },
    created () {
      Promise.all([
        store.dispatch('user/setQueryParams', {
          sort: 'created_at',
          direction: 'desc',
          page: 1,
          perPage: 5,
          only: ['id', 'name', 'email', 'type', 'created_at'].join(','),
          limit: 10,
        }),
        store.dispatch('user/getList')
      ]).then(() => {
        this.loading = false
      })
    },
    methods: {
      ...mapActions('user', ['getList']),

      goToDetail (id) {
        this.$router.push({ name: 'userDetail', params: { id: id } })
      },

      handleCurrentChange (currentPage) {
        this.getData({
          ...this.queryParams,
          page: currentPage,
        })
      },

      getData (queryParams) {
        return this.getList(queryParams)
      },
    },
  }
</script>

<style scoped>
</style>
