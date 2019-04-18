<template>
  <div class="box box-widget" v-if="resource">
    <!--<div class="row">-->
    <!--<div class="col-sm-12" style="margin-top: 20px">-->
    <!--<div class="col-sm-6" style="padding: 0; float: left">-->
    <!--&lt;!&ndash;<SearchForm @fetchList="resetTable" @search="searchTable"></SearchForm>&ndash;&gt;-->
    <!--</div>-->
    <!--<div class="col-sm-2 col-sm-offset-4 margin-bottom" style="padding-right: 0; display: block; overflow: auto">-->
    <!--<button @click="$emit('routeToNew')" class="btn btn-success pull-right"><i class="fa fa-plus"></i> New-->
    <!--</button>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->

    <div class="box-header">
      <router-link :to="{name: 'faqNew'}" class="btn btn-success"><i class="fa fa-plus"></i> New</router-link>
    </div>

    <div class="box-body">
      <el-table
          v-loading="loading"
          :data="resource"
          border
          stripe
          @sort-change="handleSortChange"
          empty-text="No data"
      >
        <el-table-column
            prop="slug"
            label="slug"
            sortable
        >
          <template slot-scope="scope">
            <router-link :to="goToDetail(scope.row.id)">{{ scope.row.slug }}</router-link>
          </template>
        </el-table-column>
        <el-table-column
            prop="title"
            label="title"
            sortable
        >
        </el-table-column>
        <el-table-column
            prop="description"
            label="description"
            sortable
        >
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

  // load component
  import SearchForm from './SearchForm'

  export default {
    name: 'PostList',
    props: ['type', 'routeDetailName'],
    data () {
      return {
        loading: false,
        columns: ['id', 'slug', 'title', 'description'],
        sortValue: { ascending: 'desc', descending: 'asc' },
        sort: 'updated_at',
        direction: 'desc',
        // params: {
        //   page: 1,
        //   perPage: 10,
        //   sort: 'updated_at',
        //   direction: 'desc',
        //   type: this.type,
        // },
        // sort: { ascending: 'asc', descending: 'desc' },
        // columns: [
        //   {
        //     title: 'Id',
        //     key: 'id',
        //     dataIndex: 'id',
        //     sorter: true,
        //   },
        //   {
        //     title: 'Thumbnail',
        //     dataIndex: 'thumbnail',
        //     scopedSlots: { customRender: 'thumbnail' },
        //   },
        //   {
        //     title: 'Title',
        //     key: 'title',
        //     dataIndex: 'title',
        //     sorter: true,
        //   },
        //   {
        //     title: 'Status',
        //     key: 'publish',
        //     dataIndex: 'publish',
        //     sorter: true,
        //     scopedSlots: { customRender: 'status' },
        //   },
        //   {
        //     title: 'Action',
        //     dataIndex: 'action',
        //     scopedSlots: { customRender: 'action' },
        //   },
        // ],
      }
    },
    computed: {
      ...mapGetters('post', {
        resource: 'getAll',
        pagination: 'getPaginator',
      }),
    },
    methods: {
      ...mapActions('post', [
        'fetchList',
      ]),

      goToDetail (id) {
        return { name: this.routeDetailName, params: { id: id } };
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

      updateList () {
        this.loading = true
        let query = {
          sort: this.sort,
          direction: this.direction,
          type: this.type,
          page: this.pagination.page || 1,
          perPage: this.pagination.perPage || 10,
          only: this.columns.join(','),
        }
        this.fetchList(query).then(() => this.loading = false)
      },

      // searchTable (searchKey) {
      //   const params = {
      //     title: searchKey,
      //   }
      //   this.fetchList(params)
      // },
      //
      // resetTable () {
      //   const initialParams = {
      //     page: 1,
      //     perPage: 10,
      //     sort: 'updated_at',
      //     direction: 'desc',
      //     type: this.type,
      //   }
      //   this.params = { ...initialParams }
      //   this.fetchList()
      // },
    },
    components: { SearchForm },
    // methods: {
    //   fetchPostList (options) {
    //     this.loading = true
    //     this.params = _.assign(this.params, options)
    //     this.$store.dispatch('post/getPostList', this.params).then(() => this.loading = false)
    //   },
    //   sortTable ({ prop, order }) {
    //     this.params.sort = prop
    //     this.params.direction = this.sort[order]
    //     this.fetchPostList()
    //   },
    //   paginate (currentPage) {
    //     this.params.page = currentPage
    //     this.params.perPage = this.pagination.pageSize
    //     this.fetchPostList()
    //   },
    //   onDelete (key) {
    //     this.$confirm('Are you sure you want to delete this item?', {
    //       confirmButtonText: 'OK',
    //       cancelButtonText: 'Cancel',
    //       type: 'warning',
    //     }).then(() => {
    //       this.$store.dispatch('post/deletePost', key).then(() => {
    //         this.$message({
    //           type: 'success',
    //           message: 'Delete completed',
    //         })
    //         this.fetchPostList()
    //       })
    //     })
    //   },
    // },
  }
</script>

<style scoped>

</style>
