<template>
  <div class="box-body" v-if="posts">
    <div class="row">
      <div class="col-sm-12" style="margin-top: 20px">
        <div class="col-sm-6" style="padding: 0; float: left">
          <SearchForm @fetchList="reset" @search="search"></SearchForm>
        </div>
        <div class="col-sm-2 col-sm-offset-4 margin-bottom" style="padding-right: 0; display: block; overflow: auto">
          <button @click="$emit('routeToNew')" class="btn btn-success pull-right"><i class="fa fa-plus"></i> New</button>
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
          <button class="btn btn-default margin-r-5" @click="$emit('edit', scope.row.id)">Edit</button>
          <button class="btn btn-danger" @click="onDelete(scope.row.id)">Delete</button>
        </template>
      </el-table-column>
    </el-table>
    <!--<a-table bordered-->
    <!--:dataSource="posts"-->
    <!--:columns="columns"-->
    <!--:rowKey="record => record.id"-->
    <!--:loading="loading"-->
    <!--:pagination="pagination"-->
    <!--@change="change">-->
    <!--<template slot="thumbnail" slot-scope="text, record">-->
    <!--<img :src="record.thumbnail" height="50" width="auto">-->
    <!--</template>-->

    <!--<template slot="status" slot-scope="text, record">-->
    <!--{{text ? 'Publish' : 'Draft'}}-->
    <!--</template>-->
    <!--<template slot="action" slot-scope="text, record">-->
    <!--<a-button @click="$emit('edit', record.id)">Edit</a-button>-->
    <!--<a-popconfirm-->
    <!--v-if="posts.length"-->
    <!--title="Are you sure to delete?"-->
    <!--@confirm="onDelete(record.id)">-->
    <!--<a-button type="danger">Delete</a-button>-->
    <!--</a-popconfirm>-->
    <!--</template>-->
    <!--</a-table>-->

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
    name: 'PostList',
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
        this.$confirm('Are you sure you want to delete this item?', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
        }).then(() => {
          this.$store.dispatch('post/deletePost', key).then(() => {
            this.$message({
              type: 'success',
              message: 'Delete completed',
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
        }
        this.params = { ...initialParams }
        this.fetchPostList()
      },
    },
  }
</script>

<style scoped>

</style>
