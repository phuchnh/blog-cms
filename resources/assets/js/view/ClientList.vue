<template>
  <div class="box" v-if="clients">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12" style="margin-top: 20px">
          <div class="col-sm-5" style="padding: 0; float: left">
            <SearchForm @fetchList="reset" @search="search"></SearchForm>
          </div>
          <div class="col-sm-2 col-sm-offset-5 margin-bottom" style="padding-right: 0; display: block; overflow: auto">
            <button @click="routeToNew" class="btn btn-success pull-right"><i class="fa fa-plus"></i> New</button>
          </div>
        </div>
      </div>

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
            prop="thumbnail"
            label="Thumbnail">
          <template slot-scope="scope">
            <img :src="scope.row.thumbnail" height="50" width="auto">
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

      <div class="pagination-container">
        <el-pagination
            background
            layout="prev, pager, next"
            :current-page="params.page"
            :page-size="pagination.pageSize"
            :total="pagination.total"
            @current-change="paginate">
        </el-pagination>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import SearchForm from '../components/SearchForm'

  export default {
    name: 'ClientList',
    components: { SearchForm },
    computed: {
      ...mapGetters('client', {
        clients: 'clients',
        pagination: 'pagination',
      }),
    },
    data () {
      return {
        loading: true,
        sort: { ascending: 'asc', descending: 'desc' },
        params: {
          page: 1,
          perPage: 10,
          sort: 'updated_at',
          direction: 'desc',
        },
        columns: [
          {
            title: 'Id',
            key: 'id',
            dataIndex: 'id',
            sorter: true,
          },
          {
            title: 'Thumbnail',
            key: 'thumbnail',
            dataIndex: 'thumbnail',
          },
          {
            title: 'Name',
            key: 'name',
            dataIndex: 'name',
            sorter: true,
          },
          {
            title: 'Action',
            dataIndex: 'action',
            scopedSlots: { customRender: 'action' },
          },
        ],
      }
    },
    mounted () {
      this.fetchClientList()
    },
    methods: {
      fetchClientList (options) {
        this.loading = true
        this.params = _.assign(this.params, options)
        this.$store.dispatch('client/getClientList', this.params).then(() => this.loading = false)
      },
      sortTable ({ prop, order }) {
        this.params.sort = prop
        this.params.direction = this.sort[order]
        this.fetchClientList()
      },
      paginate (currentPage) {
        this.params.page = currentPage
        this.params.perPage = this.pagination.pageSize
        this.fetchClientList()
      },
      onDelete (key) {
        this.$confirm('Are you sure you want to delete this item?', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
        }).then(() => {
          this.$store.dispatch('client/deleteClient', key).then(() => {
            this.$message({
              type: 'success',
              message: 'Delete completed',
            })
            this.fetchClientList()
          })
        })
      },
      routeToDetail (id) {
        this.$router.push({ name: 'clientDetail', params: { id: id } })
      },
      routeToNew () {
        this.$router.push({ name: 'clientNew' })
      },
      search (searchKey) {
        const params = {
          name: searchKey,
        }
        this.fetchClientList(params)
      },
      reset () {
        const initialParams = {
          page: 1,
          perPage: 10,
          sort: 'updated_at',
          direction: 'desc',
        }
        this.params = { ...initialParams }
        this.fetchClientList()
      },
    },
  }
</script>

<style scoped>

</style>
