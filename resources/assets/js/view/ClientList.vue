<template>
  <div class="box" v-if="clients">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12" style="margin-top: 20px">
          <div class="col-sm-6" style="padding: 0; float: left">
            <SearchForm @fetchList="fetchClientList" @search="search"></SearchForm>
          </div>
          <div class="col-sm-2 col-sm-offset-4 margin-bottom" style="padding-right: 0; display: block; overflow: auto">
            <button @click="routeToNew" class="btn btn-primary pull-right">Add New</button>
          </div>
        </div>
      </div>

      <a-table bordered
               :dataSource="clients"
               :columns="columns"
               :rowKey="record => record.id"
               :loading="loading"
               :pagination="pagination"
               @change="change">
        <template slot="action" slot-scope="text, record">
          <a-button @click="routeToDetail(record.id)">Edit</a-button>
          <a-popconfirm
              v-if="clients.length"
              title="Are you sure to delete?"
              @confirm="onDelete(record.id)">
            <a-button type="danger">Delete</a-button>
          </a-popconfirm>
        </template>
      </a-table>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import SearchForm from '../components/SearchForm'

  export default {
    name: 'ClientList',
    components: {SearchForm},
    computed: {
      ...mapGetters('client', {
        clients: 'clients',
        pagination: 'pagination',
      }),
    },
    data () {
      return {
        loading: true,
        sort: { ascend: 'asc', descend: 'desc' },
        columns: [
          {
            title: 'Id',
            key: 'id',
            dataIndex: 'id',
            sorter: true
          },
          {
            title: 'Thumbnail',
            key: 'thumbnail',
            dataIndex: 'thumbnail'
          },
          {
            title: 'Name',
            key: 'name',
            dataIndex: 'name',
            sorter: true
          },
          {
            title: 'Action',
            dataIndex: 'action',
            scopedSlots: { customRender: 'action' },
          },
        ],
      }
    },
    mounted () {
      this.fetchClientList()
    },
    methods: {
      fetchClientList (options) {
        this.loading = true

        let params = {
          page: 1,
          perPage: 10,
        }

        params = _.assign(params, options)

        this.$store.dispatch('client/getClientList', params).then(() => this.loading = false)
      },
      change (pagination, filters, sorter) {
        this.loading = true

        let params = {
          sort: sorter.field || 'updated_at',
          direction: this.sort[sorter.order] || 'desc',
          page: pagination.current,
          perPage: pagination.pageSize,
        }

        this.$store.dispatch('client/getClientList', params).then(() => this.loading = false)
      },
      onDelete (key) {
        this.$store.dispatch('client/deleteClient', key).then(() => this.fetchClientList())
      },
      routeToDetail (id) {
        this.$router.push({ name: 'clientDetail', params: { id: id } })
      },
      routeToNew () {
        this.$router.push({ name: 'clientNew' })
      },
      search (searchKey) {
        const params = {
          name: searchKey,
        }
        this.fetchClientList(params)
      },
    },
  }
</script>

<style scoped>

</style>
