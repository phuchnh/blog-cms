<template>
  <div class="box box-widget" v-if="list">
    <div class="box-header">
        <a @click="exportCSV" class="btn btn-success pull-right"><i class="fa fa-download"></i> Export</a>
    </div>
    <div class="box-body">
      <SearchBox :columns="columns" :modes="modes" @change="handleSearch"/>
    </div>

    <div class="box-body">
      <div class="row">
        <div class="col-xs-12 col-lg-2 col-md-3 pull-right" style="margin: 20px 0">
          <select v-model="contactType" class="form-control" @change="fetchList">
            <option v-for="type in contactTypes" :value="type.value">{{ type.name }}</option>
          </select>
        </div>
      </div>
      <el-table
          :data="list"
          border
          stripe
          v-loading="loading"
          empty-text="No data">
        <el-table-column
            prop="id"
            label="Id">
        </el-table-column>
        <el-table-column
            prop="email_address"
            label="Email">
        </el-table-column>
        <el-table-column
            prop="merge_fields"
            label="Name">
          <template slot-scope="scope">
            {{ scope.row.merge_fields.MMERGE3 }}
          </template>
        </el-table-column>
        <el-table-column
            prop="status"
            label="Status">
          <template slot-scope="scope">
            {{ scope.row.status | capitalize }}
          </template>
        </el-table-column>
        <el-table-column
            label="Action"
            width="100">
          <template slot-scope="scope">
            <button class="btn btn-default margin-r-5" @click="routeToDetail(scope.row.email_address)">View</button>
          </template>
        </el-table-column>
      </el-table>
    </div>

    <div class="box-footer text-center">
      <el-pagination
          background
          layout="prev, pager, next"
          :current-page="queryParams.page"
          :page-size="pagination.pageSize"
          :total="pagination.total"
          @current-change="paginate">
      </el-pagination>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import SearchBox from '../components/SearchBox'

  export default {
    name: 'SubscriberList',
    components: { SearchBox },
    computed: {
      ...mapGetters('subscriber', {
        list: 'list',
        pagination: 'pagination',
        queryParams: 'getQueryParams',
      }),
    },
    data () {
      return {
        loading: true,
        sort: { ascending: 'asc', descending: 'desc' },
        columns: ['Email'],
        modes: ['Contain'],
        contactTypes: [
          {value: 'meeting', name: 'Book A Meeting'},
          {value: 'company', name: 'For Company'},
          {value: 'individual', name: 'For Individual'},
          {value: 'newsletter', name: 'Pro List'}
        ],
        contactType: 'company'
      }
    },
    mounted () {
      this.fetchList()
    },
    methods: {
      fetchList () {
        this.loading = true
        Promise.all([
          this.$store.dispatch('subscriber/setContactType', this.contactType),
          this.$store.dispatch('subscriber/getList')
        ]).then(() => this.loading = false)
      },
      paginate (currentPage) {
        this.fetchList({
          ...this.queryParams,
          page: currentPage,
        })
      },
      routeToDetail (email) {
        this.$router.push({ name: 'SubscriberDetail', params: { email: email } })
      },
      handleSearch (value) {
        const queryParams = _.merge(this.queryParams, value)
        this.fetchList(queryParams)
      },
      exportCSV () {
        this.$store.dispatch('subscriber/exportCSV', {type: this.contactType})
      }
    },
  }
</script>

<style scoped>

</style>
