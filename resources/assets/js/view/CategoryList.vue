<template>
  <div class="box" v-if="categories">
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
          :data="categories"
          border
          stripe
          v-loading="loading"
          @sort-change="sortTable"
          empty-text="No data"
          row-key="id"
          default-expand-all>
        <el-table-column
            prop="id"
            label="Id"
            width="100"
            sortable="custom">
        </el-table-column>
        <el-table-column
            prop="title"
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
            :current-page="1"
            :page-size="2"
            :total="categories.length">
        </el-pagination>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import SearchForm from '../components/SearchForm'

  export default {
    name: 'CategoryList',
    components: { SearchForm },
    computed: {
      ...mapGetters('taxonomy', {
        categories: 'getAll',
        pagination: 'getPaginator',
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
          type: 'category',
          tree: true
        },
      }
    },
    mounted () {
      this.fetchList()
    },
    methods: {
      fetchList (options) {
        this.loading = true
        this.params = _.assign(this.params, options)
        this.$store.dispatch('taxonomy/fetchList', this.params).then(() => this.loading = false)
      },
      sortTable ({ prop, order }) {
        this.params.sort = prop
        this.params.direction = this.sort[order]
        this.fetchList()
      },
      paginate (currentPage) {
        this.params.page = currentPage
        this.params.perPage = this.pagination.pageSize
        this.fetchList()
      },
      onDelete (key) {
        this.$confirm('Are you sure you want to delete this item?', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
        }).then(() => {
          this.$store.dispatch('taxonomy/delete', key).then(() => {
            this.$message({
              type: 'success',
              message: 'Delete completed',
            })
            this.fetchList()
          })
        })
      },
      routeToDetail (id) {
        this.$router.push({ name: 'categoryDetail', params: { id: id } })
      },
      routeToNew () {
        this.$router.push({ name: 'categoryNew' })
      },
      search (searchKey) {
        const params = {
          name: searchKey,
        }
        this.fetchList(params)
      },
      reset () {
        const initialParams = {
          page: 1,
          perPage: 10,
          sort: 'updated_at',
          direction: 'desc',
          type: 'category'
        }
        this.params = { ...initialParams }
        this.fetchList()
      },
    },
  }
</script>

<style scoped>

</style>
