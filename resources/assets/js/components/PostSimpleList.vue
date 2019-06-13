<template>
  <div class="box box-widget">
    <div class="box-header">
      <router-link :to="{name: redirectToNew}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> New
      </router-link>
    </div>
    <div class="box-body">
      <SearchBox @change="handleSearch"/>
    </div>

    <!-- /.box-box-body -->
    <div class="box-body">
      <div class="row">
        <div class="col-xs-12 col-lg-2 col-md-3 pull-right" style="margin: 20px 0">
          <select class="form-control" @change="getListByLanguage" v-model="locale">
            <option value="vi" selected>Tiếng Việt</option>
            <option value="en">English</option>
          </select>
        </div>
      </div>
      <el-table
          v-loading="loading"
          :data="lists"
          border
          size="small"
          @sort-change="handleSortChange"
          empty-text="No data"
      >
        <el-table-column prop="title" label="Title" sortable style="width: 30%">
          <template slot-scope="scope" class="text-nowrap">
            <router-link :to="goToDetail(scope.row.id)">{{ scope.row.title }}</router-link>
          </template>
        </el-table-column>
        <el-table-column prop="slug" label="Slug" sortable style="width: 30%"/>
        <el-table-column v-if="getPostType == 'post_people'" prop="sort" label="Sort" sortable style="width: 10%">
          <template slot-scope="scope" class="text-nowrap">
            {{ scope.row.sort[0] ? parseInt(scope.row.sort[0]) : 0}}
          </template>
        </el-table-column>
        <el-table-column prop="publish" label="Status">
          <template slot-scope="scope">
            {{ scope.row.publish === 1 ? 'Publish' : 'Draft' }}
          </template>
        </el-table-column>
        <el-table-column label="Action" width="100">
          <template slot-scope="scope">
            <button
                class="btn btn-danger"
                @click="handleDelete(scope.$index, scope.row)">Delete
            </button>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <div class="box-footer text-center">
      <el-pagination
          layout="prev, pager, next"
          background
          :page-size="queryParams.perPage"
          :total="total"
          :current-page="queryParams.page"
          @current-change="handleCurrentChange"
      >
      </el-pagination>
    </div>
  </div>
</template>

<script>
  import store from '@/store'
  import SearchBox from '@/components/SearchBox.vue'

  import { mapGetters, mapActions } from 'vuex'
  import * as _ from 'lodash'

  export default {
    name: 'PostSimpleList',
    components: {
      SearchBox,
    },
    data () {
      return {
        visible: false,
        confirmLoading: false,
      }
    },
    computed: {
      ...mapGetters('faq', ['getLoading', 'getLists', 'getTotal', 'getQueryParams','getPostType']),
      ...mapGetters('route', {
        redirectToNew: 'redirectToNew',
        redirectToDetail: 'redirectToDetail',
      }),
      loading () {
        return this.getLoading
      },
      lists () {
        return this.getLists
      },
      total () {
        return this.getTotal
      },
      queryParams () {
        return this.getQueryParams
      },
      locale: {
        get () {
          return this.getQueryParams.locale
        },
        set (value) {
          this.$store.commit('faq/setLocale', value)
        },
      },
    },
    beforeRouteEnter (to, from, next) {
      return store.dispatch('faq/fetchList').then(() => next())
    },
    methods: {
      ...mapActions('faq', ['fetchList', 'deleteItem']),

      filterTags (taxonomies) {
        return _.reduce(taxonomies, (result, value) => {
          if (value.type === 'tags') {
            result.push({
              title: value.title,
              id: value.id,
            })
          }
          return result
        }, [])
      },

      filterGroups (taxonomies) {
        return _.reduce(taxonomies, (result, value) => {
          if (value.type === 'groups') {
            result.push({
              title: value.title,
              id: value.id,
            })
          }
          return result
        }, [])
      },

      goToDetail (id) {
        return { name: this.redirectToDetail, params: { id: id } }
      },

      handleCurrentChange (currentPage) {
        this.getData({
          ...this.queryParams,
          page: currentPage,
        })
      },

      handleSortChange ({ prop, order }) {
        const direction = { ascending: 'desc', descending: 'asc' }
        this.getData({
          ...this.queryParams,
          sort: prop,
          direction: direction[order],
        })
      },

      handleDelete (index, row) {
        this.$confirm('This will delete the item. Continue?', 'Warning', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
        }).then(() => {
          return this.deleteItem(row.id)
        }).then(() => {
          this.$message({
            type: 'success',
            message: 'Delete completed',
          })
          this.getData({
            ...this.queryParams,
            page: 1,
          })
        }).catch(() => {
          console.log('Cancel')
        })
      },

      getData (queryParams) {
        queryParams = {
          ...queryParams,
          with: 'taxonomies',
        }
        return this.fetchList(queryParams)
      },

      handleSearch (value) {
        const queryParams = _.merge(this.queryParams, value)
        this.getData(queryParams)
      },

      getListByLanguage () {
        this.fetchList()
      },
    },
  }
</script>

<style scoped>
</style>
