<template>
  <div class="box box-widget">
    <div class="box-header">
      <router-link :to="{name: 'faqNew'}" class="btn btn-success"><i class="fa fa-plus"></i> New</router-link>
    </div>

    <!-- /.box-box-body -->
    <div class="box-body">
      <el-table
          v-loading="loading"
          :data="lists"
          border
          stripe
          @sort-change="handleSortChange"
          empty-text="No data"
      >
        <el-table-column prop="slug" label="slug" sortable>
          <template slot-scope="scope">
            <router-link :to="goToDetail(scope.row.id)">{{ scope.row.slug }}</router-link>
          </template>
        </el-table-column>
        <el-table-column prop="title" label="title" sortable/>
        <el-table-column prop="description" label="description" sortable/>
      </el-table>
    </div>
    <div class="box-footer text-center">
      <el-pagination
          background
          layout="prev, pager, next"
          :page-size="queryParams.perPage"
          :total="total"
          :current-page="queryParams.page"
          @current-change="handleCurrentChange"
      >
      </el-pagination>
    </div>
  </div>
</template>

<script>
  import store from '@/store'

  import { mapGetters, mapActions } from 'vuex'

  export default {
    name: 'FaqList',
    data () {
      return {}
    },
    computed: {
      ...mapGetters('faq', ['onFetchList', 'getLists', 'getTotal', 'getQueryParams']),
      loading () {
        return this.onFetchList
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
    beforeRouteEnter (to, from, next) {
      store.dispatch('faq/fetchList').then(() => next())
    },
    methods: {
      ...mapActions('faq', ['fetchList']),

      goToDetail (id) {
        return { name: 'faqDetail', params: { id: id } }
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
        return this.fetchList(queryParams)
      },
    },
  }
</script>

<style scoped>
</style>