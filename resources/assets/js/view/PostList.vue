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
        return { name: 'postDetail', params: { id: id }, query: { type: this.$route.query.type } }
      },

      goToNew () {
        this.$router.push({ name: 'postNew', query: { type: this.$route.query.type } })
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
        this.$store.dispatch('post/fetchList', this.params).then(() => this.loading = false)
      },

      searchTable (searchKey) {
        const params = {
          title: searchKey,
        }
        this.fetchList(params)
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
        this.fetchList()
      },
    },
    components: { SearchForm },
  }
</script>

<style scoped>

</style>
