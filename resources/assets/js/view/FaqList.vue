<template>
  <div class="box box-widget">
    <!-- /.box-box-body -->
    <div class="box-body">
      <a-table
          :dataSource="faqs"
          :columns="columns"
          :rowKey="record => record.id"
          :loading="loading"
          :pagination="pagination"
          @change="handleTableChange"
          bordered
      >
      </a-table>
    </div>
  </div>
</template>

<script>
  import Vue from 'vue'
  import { Table } from 'ant-design-vue'

  Vue.use(Table)

  const columns = [
    { title: 'Slug', dataIndex: 'slug', key: 'slug', sorter: true },
    { title: 'Title', dataIndex: 'title', key: 'title', sorter: true },
    { title: 'Description', dataIndex: 'description', key: 'description', sorter: true },
  ]

  import { mapState } from 'vuex'
  import { FaqService } from '../api'

  export default {
    name: 'FaqList',
    data () {
      return {
        loading: true,
        pagination: {},
        current: 1,
        columns,
      }
    },
    computed: mapState({
      faqs: state => state.faq.data,
    }),
    beforeRouteEnter (to, from, next) {
      let params = { page: 1, perPage: 5 }
      FaqService.fetchList(params).then(res => {
        next(vm => vm.setData(res))
      })
    },
    beforeRouteUpdate (to, from, next) {},
    methods: {
      handleTableChange (pagination, filters, sorter) {
        this.loading = true
        let params = {
          sortField: sorter.field || 'id',
          sortOrder: this.transform(sorter.order) || 'desc',
          page: pagination.current,
          perPage: pagination.pageSize,
        }
        FaqService.fetchList(params).then(res => {
          this.setData(res)
        })
      },
      setData (res) {
        const { data } = res.data
        const pagination = { ...this.pagination }
        pagination.total = res.data.pagination.total
        pagination.pageSize = res.data.pagination.perPage
        this.pagination = pagination
        this.$store.commit('faq/SET_FAQ', data)
        this.loading = false
      },

      transform (value) {
        if (value === 'ascend') return 'asc'
        if (value === 'descend') return 'desc'
      },
    },
  }
</script>

<style scoped>
</style>