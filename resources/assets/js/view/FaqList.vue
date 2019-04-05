<template>
  <div class="box box-widget">
    <div class="box-header">
      <router-link :to="{name: 'faqNew'}" class="btn btn-success"><i class="fa fa-plus"></i> New</router-link>
    </div>
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
      change (pagination, filters, sorter) {
        this.loading = true
        let params = {
          sort: sorter.field || 'updated_at',
          direction: this.sort[sorter.order] || 'desc',
          page: pagination.current,
          perPage: pagination.pageSize,
          only: 'id,slug,title,description',
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