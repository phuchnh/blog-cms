<template>
  <div class="box" v-if="users">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12" style="margin-top: 20px">
          <div class="col-sm-6" style="padding: 0; float: left">
            <SearchForm @fetchList="reset" @search="search"></SearchForm>
          </div>
        </div>
      </div>

      <el-table
          :data="users"
          border
          stripe
          style="width: 100%"
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
            prop="name"
            label="Name"
            width="700"
            sortable="custom">
        </el-table-column>
        <el-table-column
            label="Role"
            prop="type"
            sortable="custom">
          <template slot-scope="scope">
            {{ scope.row.type | capitalize }}
          </template>
        </el-table-column>
        <el-table-column
            label="Action">
          <template slot-scope="scope">
            <button class="btn btn-default margin-r-5" @click="routeToDetail(scope.row.id)">Edit</button>
            <button class="btn btn-danger" @click="onDelete(scope.row.id)">Delete</button>
          </template>
        </el-table-column>
      </el-table>
      <div class="pull-right" style="margin-top: 20px">
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
    name: 'UserList',
    components: { SearchForm },
    computed: {
      ...mapGetters('user', {
        users: 'users',
        pagination: 'pagination',
      }),
    },
    data () {
      return {
        loading: true,
        sort: { ascending: 'asc', descending: 'desc' },
        columns: [
          {
            title: 'Id',
            key: 'id',
            dataIndex: 'id',
            sorter: true,
          },
          {
            title: 'Name',
            key: 'name',
            dataIndex: 'name',
            sorter: true,
          },
          {
            title: 'Role',
            key: 'type',
            dataIndex: 'type',
            sorter: true,
          },
          {
            title: 'Action',
            dataIndex: 'action',
            scopedSlots: { customRender: 'action' },
          },
        ],
        params: {
          page: 1,
          perPage: 10,
          sort: 'updated_at',
          direction: 'desc'
        }
      }
    },
    mounted () {
      this.fetchUserList()
    },
    methods: {
      fetchUserList (options) {
        this.loading = true
        this.params = _.assign(this.params, options)
        this.$store.dispatch('user/getUserList', this.params).then(() => this.loading = false)
      },
      sortTable ({prop, order}) {
        this.params.sort = prop
        this.params.direction = this.sort[order]
        this.fetchUserList()
      },
      paginate (currentPage) {
        this.params.page = currentPage
        this.params.perPage = this.pagination.pageSize
        this.fetchUserList()
      },
      routeToDetail (id) {
        this.$router.push({ name: 'userDetail', params: { id: id } })
      },
      onDelete (key) {
        this.$confirm('Are you sure you want to delete this item?', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
        }).then(() => {
          this.$store.dispatch('user/deleteUser', key)
        }).then(() => {
          this.$message({
            type: 'success',
            message: 'Delete completed',
          })
          this.fetchUserList()
        })
      },
      search (searchKey) {
        const params = {
          name: searchKey,
        }
        this.fetchUserList(params)
      },
      reset () {
        const initialParams = {
          page: 1,
          perPage: 10,
          sort: 'updated_at',
          direction: 'desc',
        };
        this.params = {...initialParams}
        this.fetchUserList()
      }
    },
  }
</script>

<style scoped>

</style>
