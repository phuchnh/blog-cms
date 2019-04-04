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
          @change="change"
          bordered
      >
        <router-link slot="slug" slot-scope="slug, record" :to="goToDetail(record.id)">{{ slug }}</router-link>
      </a-table>
    </div>
  </div>
</template>

<script>
  import Vue from 'vue'
  import store from '@/store'
  import { Table } from 'ant-design-vue'

  Vue.use(Table)

  import { mapGetters, mapActions } from 'vuex'

  export default {
    name: 'FaqList',
    data () {
      return {
        data: null,
        loading: true,
        sort: { ascend: 'asc', descend: 'desc' },
        columns: [
          { title: 'Slug', dataIndex: 'slug', key: 'slug', sorter: true, scopedSlots: { customRender: 'slug' } },
          { title: 'Title', dataIndex: 'title', key: 'title', sorter: true },
          { title: 'Description', dataIndex: 'description', key: 'description', sorter: true },
        ],
      }
    },
    computed: {
      ...mapGetters('faq', {
        faqs: 'getAll',
        pagination: 'getPaginator',
      }),
    },
    beforeRouteEnter (to, from, next) {
      store.dispatch('faq/fetchList').then(() => next(vm => {
        vm.loading = false
      }))
    },
    methods: {
      ...mapActions('faq', [
        'fetchList',
      ]),
      goToDetail (id) {
        return { name: 'faqDetail', params: { id: id } }
      },
      change (pagination, filters, sorter) {
        this.loading = true
        let params = {
          sort: sorter.field || 'id',
          direction: this.sort[sorter.order] || 'desc',
          page: pagination.current,
          perPage: pagination.pageSize,
        }
        this.fetchList(params).then(
          () => this.loading = false,
        )
      },
    },
  }
</script>

<style scoped>
</style>