<template>
  <div class="box box-widget">
    <div class="box-header">
      <router-link :to="{name: 'faqNew'}" class="btn btn-success"><i class="fa fa-plus"></i> New</router-link>
    </div>

    <!-- /.box-box-body -->
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
  import store from '@/store'

  import { mapGetters, mapActions } from 'vuex'

  export default {
    name: 'FaqList',
    data () {
      return {
        loading: true,
        columns: ['id', 'slug', 'title', 'description'],
        sortValue: { ascending: 'desc', descending: 'asc' },
        sort: 'updated_at',
        direction: 'desc',
      }
    },
    computed: {
      ...mapGetters('faq', {
        resource: 'getAll',
        pagination: 'getPaginator',
      }),
    },
    beforeRouteEnter (to, from, next) {
      store.dispatch('faq/fetchList', {
        sort: 'updated_at',
        direction: 'desc',
        page: 1,
        perPage: 10,
        only: 'id,slug,title,description',
      }).then(
        () => next(
          vm => {
            vm.loading = false
          }),
      )
    },
    beforeRouteUpdate (to, from, next) {
      this.loading = true
      store.dispatch('faq/fetchItem', to.params.id).then(
        () => {
          this.loading = false
          next()
        },
      )
    },
    methods: {
      ...mapActions('faq', [
        'fetchList',
      ]),

      goToDetail (id) {
        return { name: 'faqDetail', params: { id: id } }
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
          page: this.pagination.page || 1,
          perPage: this.pagination.perPage || 10,
          only: this.columns.join(','),
        }
        this.fetchList(query).then(() => this.loading = false)
      },
    },
  }
</script>

<style scoped>
</style>