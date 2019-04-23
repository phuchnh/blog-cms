<template>
  <div class="box box-widget" v-if="resource">
    <div class="box-header" style="padding: 20px 10px 0 10px">
      <div class="col-sm-6" style="padding: 0; float: left">
        <SearchForm @fetchList="resetTable" @search="searchTable"></SearchForm>
      </div>
      <button @click="goToNew" class="btn btn-success pull-right"><i class="fa fa-plus"></i> New</button>
    </div>

    <div class="box-body">
      <el-table
          :data="resource"
          border
          stripe
          v-loading="loading"
          @sort-change="handleSortChange"
          empty-text="No data">
        <el-table-column
            prop="id"
            label="Id"
            width="100"
            sortable="custom">
        </el-table-column>
        <el-table-column
            prop="title"
            label="Title"
            sortable="custom">
        </el-table-column>
        <el-table-column
            label="Status"
            prop="publish"
            sortable="custom">
          <template slot-scope="scope">
            {{scope.row.publish ? 'Publish' : 'Draft'}}
          </template>
        </el-table-column>
        <el-table-column
            label="Action">
          <template slot-scope="scope">
            <button class="btn btn-default margin-r-5" @click="goToDetail(scope.row.id)">Edit</button>
            <button class="btn btn-danger" @click="onDelete(scope.row.id)">Delete</button>
          </template>
        </el-table-column>
      </el-table>
    </div>

    <div class="box-footer text-center">
      <el-pagination
          background
          layout="prev, pager, next"
          :page-size="pagination.perPage"
          :total="pagination.total"
          :current-page="pagination.currentPage"
          @current-change="handleCurrentChange"
      >
      </el-pagination>
    </div>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'
  import store from '@/store'

  // load component
  import SearchForm from './../components/SearchForm'

  export default {
    name: 'PostList',
    props: ['routeDetailName'],
    data () {
      return {
        loading: false,
        columns: ['id', 'slug', 'title', 'description'],
        sortValue: { ascending: 'desc', descending: 'asc' },
        sort: 'updated_at',
        direction: 'desc',
        type: this.$route.query.type,
        params: {
          sort: 'updated_at',
          direction: 'desc',
          type: this.$route.query.type,
          page: 1,
          perPage: 10,
        }
      }
    },
    beforeRouteUpdate (to, from, next) {
      this.params = {...this.params, type: to.query.type}
      this.updateList()
      next()
    },
    computed: {
      ...mapGetters('post', {
        resource: 'getAll',
        pagination: 'getPaginator',
      }),
    },
    mounted () {
      this.updateList()
    },
    methods: {
      goToDetail (id) {
        this.$router.push({ name: 'postDetail', params: { id: id }, query: { type: this.$route.query.type } })
      },

      goToNew () {
        this.$router.push({ name: 'postNew', query: { type: this.$route.query.type } })
      },

      onDelete (key) {
        this.$confirm('Are you sure you want to delete this item?', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
        }).then(() => {
          this.$store.dispatch('post/delete', key).then(() => {
            this.$message({
              type: 'success',
              message: 'Delete completed',
            })
            this.updateList()
          })
        })
      },

      handleCurrentChange (currentPage) {
        this.pagination.page = currentPage
        this.updateList()
      },

      handleSortChange ({ prop, order }) {
        this.sort = prop
        this.direction = this.sortValue[order]
        this.updateList()
      },

      updateList (options) {
        this.loading = true
        this.params = _.assign(this.params, options)
        this.$store.dispatch('post/fetchList', this.params).then(() => this.loading = false)
      },

      searchTable (searchKey) {
        const params = {
          title: searchKey,
        }
        this.updateList(params)
      },

      resetTable () {
        const initialParams = {
          page: 1,
          perPage: 10,
          sort: 'updated_at',
          direction: 'desc',
          type: this.type,
        }
        this.params = { ...initialParams }
        this.updateList()
      },
    },
    components: { SearchForm },
  }
</script>

<style scoped>

</style>
