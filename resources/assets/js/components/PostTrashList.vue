<template>
  <div class="box-body" v-if="posts">
    <div class="row">
      <div class="col-sm-12" style="margin-top: 20px">
        <div class="col-sm-6" style="padding: 0; float: left">
          <SearchForm @fetchList="reset" @search="search"></SearchForm>
        </div>
      </div>
    </div>

    <el-table
        :data="posts"
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
          <button class="btn btn-success margin-r-5" @click="restore(scope.row.id)">Restore</button>
          <button class="btn btn-danger" @click="onDelete(scope.row.id)">Delete Permanently</button>
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
</template>

<script>
  import { mapGetters } from 'vuex'
  import SearchForm from './SearchForm'

  export default {
    name: 'PostTrashList',
    components: { SearchForm },
    computed: {
      ...mapGetters('post', {
        posts: 'posts',
        pagination: 'pagination',
      }),
    },
    props: {
      type: String,
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
          type: this.type,
          trash: true
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
            dataIndex: 'thumbnail',
            scopedSlots: { customRender: 'thumbnail' },
          },
          {
            title: 'Title',
            key: 'title',
            dataIndex: 'title',
            sorter: true,
          },
          {
            title: 'Status',
            key: 'publish',
            dataIndex: 'publish',
            sorter: true,
            scopedSlots: { customRender: 'status' },
          },
          {
            title: 'Action',
            dataIndex: 'action',
            scopedSlots: { customRender: 'action' },
          },
        ],
      }
    },
    created () {
      this.fetchPostList()
    },
    methods: {
      fetchPostList (options) {
        this.loading = true
        this.params = _.assign(this.params, options)
        this.$store.dispatch('post/getPostList', this.params).then(() => this.loading = false)
      },
      sortTable ({ prop, order }) {
        this.params.sort = prop
        this.params.direction = this.sort[order]
        this.fetchPostList()
      },
      paginate (currentPage) {
        this.params.page = currentPage
        this.params.perPage = this.pagination.pageSize
        this.fetchPostList()
      },
      onDelete (key) {
        this.$confirm('Are you sure you want to delete permanently this item?', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
        }).then(() => {
          this.$store.dispatch('post/deletePermanentlyPost', key).then(() => {
            this.$message({
              type: 'success',
              message: 'Delete completed',
            })
            this.fetchPostList()
          })
        })
      },
      restore (key) {
        this.$confirm('Are you sure you want to restore this item?', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
        }).then(() => {
          this.$store.dispatch('post/restorePost', key).then(() => {
            this.$message({
              type: 'success',
              message: 'Restore successfully',
            })
            this.fetchPostList()
          })
        })
      },
      search (searchKey) {
        const params = {
          title: searchKey,
        }
        this.fetchPostList(params)
      },
      reset () {
        const initialParams = {
          page: 1,
          perPage: 10,
          sort: 'updated_at',
          direction: 'desc',
          type: this.type,
          trash: true
        }
        this.params = { ...initialParams }
        this.fetchPostList()
      },
    },
  }
</script>

<style scoped>

</style>
