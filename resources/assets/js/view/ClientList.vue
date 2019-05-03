<template>
  <div class="box box-widget" v-if="clients">
    <div class="box-header">
      <router-link :to="{name: 'clientNew'}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> New
      </router-link>
    </div>
    <div class="box-body">
      <SearchBox :columns="columns" @change="handleSearch"/>
    </div>

    <div class="box-body">
      <el-table
          :data="clients"
          border
          stripe
          v-loading="loading"
          @sort-change="sortTable"
          empty-text="No data">
        <el-table-column
            prop="id"
            label="Id"
            width="100"
            sortable="custom">
        </el-table-column>
        <el-table-column
            label="Thumbnail">
          <template slot-scope="scope">
            <img :src="scope.row.meta.thumbnail.url" height="50" width="auto">
          </template>
        </el-table-column>
        <el-table-column
            prop="name"
            label="Name"
            sortable="custom">
        </el-table-column>
        <el-table-column
            label="Action">
          <template slot-scope="scope">
            <button class="btn btn-default margin-r-5" @click="routeToDetail(scope.row.id)">Edit</button>
            <button class="btn btn-danger" @click="onDelete(scope.row.id)">Delete</button>
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
    name: 'ClientList',
    components: { SearchBox },
    computed: {
      ...mapGetters('client', {
        clients: 'clients',
        pagination: 'pagination',
        queryParams: 'getQueryParams',
      }),
    },
    data () {
      return {
        loading: true,
        sort: { ascending: 'asc', descending: 'desc' },
        columns: ['Name']
      }
    },
    mounted () {
      this.fetchClientList()
    },
    methods: {
      fetchClientList (options) {
        this.loading = true
        this.$store.dispatch('client/getList', options).then(() => this.loading = false)
      },
      sortTable ({ prop, order }) {
        this.fetchClientList({
          ...this.queryParams,
          sort: prop,
          direction: this.sort[order],
        })
      },
      paginate (currentPage) {
        this.fetchClientList({
          ...this.queryParams,
          page: currentPage,
        })
      },
      onDelete (key) {
        this.$confirm('Are you sure you want to delete this item?', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
        }).then(() => {
          this.$store.dispatch('client/delete', key).then(() => {
            this.$message({
              type: 'success',
              message: 'Delete completed',
            })
            this.fetchClientList({
              ...this.queryParams,
              page: 1,
            })
          })
        })
      },
      routeToDetail (id) {
        this.$router.push({ name: 'clientDetail', params: { id: id } })
      },
      routeToNew () {
        this.$router.push({ name: 'clientNew' })
      },
      handleSearch (value) {
        const queryParams = _.merge(this.queryParams, value)
        this.fetchClientList(queryParams)
      },
    },
  }
</script>

<style scoped>

</style>
