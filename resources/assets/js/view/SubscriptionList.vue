<template>
  <div class="box box-widget" v-if="list">
    <div class="box-body">
      <SearchBox :columns="columns" :modes="modes" @change="handleSearch"/>
    </div>

    <div class="box-body">
      <el-table
          :data="list"
          border
          stripe
          v-loading="loading"
          empty-text="No data">
        <el-table-column
            prop="id"
            label="Id">
        </el-table-column>
        <el-table-column
            prop="email"
            label="Email">
        </el-table-column>
        <el-table-column
            prop="merge_fields"
            label="Name">
          <template slot-scope="scope">
            {{ scope.row.name }}
          </template>
        </el-table-column>
        <el-table-column
            prop="type"
            label="Type">
          <template slot-scope="scope">
            {{ scope.row.type }}
          </template>
        </el-table-column>
        <el-table-column
            label="Action"
            width="100">
          <template slot-scope="scope">
            <button class="btn btn-default margin-r-5" @click="routeToDetail(scope.row.id)">View</button>
          </template>
        </el-table-column>
      </el-table>
    </div>

    <div class="box-footer text-center">
      <el-pagination
          background
          layout="prev, pager, next"
          :current-page="queryParams.page"
          :page-size="pagination.pageSize"
          :total="pagination.total"
          @current-change="paginate">
      </el-pagination>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import SearchBox from '../components/SearchBox'

  export default {
    name: 'SubscriptionList',
    components: { SearchBox },
    computed: {
      ...mapGetters('subscription', {
        list: 'list',
        pagination: 'pagination',
        queryParams: 'getQueryParams',
      }),
    },

    data () {
      return {
        loading: true,
        sort: { ascending: 'asc', descending: 'desc' },
        columns: ['Email'],
        modes: ['Contain'],
      }
    },

    mounted () {
      this.fetchList()
    },

    methods: {
      /**
       * get list from store
       * @param options
       */
      fetchList (options) {
        this.loading = true
        this.$store.dispatch('subscription/getList', options).then(() => this.loading = false)
      },

      paginate (currentPage) {
        this.fetchList({
          ...this.queryParams,
          page: currentPage,
        })
      },

      routeToDetail (id) {
        this.$router.push({ name: 'SubscriptionDetail', params: { id: id } })
      },

      handleSearch (value) {
        const queryParams = _.merge(this.queryParams, value)
        this.fetchList(queryParams)
      },
    },
  }
</script>

<style scoped>

</style>