<template>
  <div class="box" v-if="users">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12" style="margin-top: 20px">
          <div class="col-sm-6" style="padding: 0; float: left">
            <SearchForm @fetchList="fetchUserList" @search="search"></SearchForm>
          </div>
        </div>
      </div>

      <a-table bordered
               :dataSource="users"
               :columns="columns"
               :rowKey="record => record.id"
               :loading="loading"
               :pagination="pagination"
               @change="change">
        <template slot="action" slot-scope="text, record">
          <a-button @click="routeToDetail(record.id)">Edit</a-button>
          <a-popconfirm
              v-if="users.length"
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
    name: 'UserList',
    components: { SearchForm },
    title: 'User List',
    computed: {
      ...mapGetters('user', {
        users: 'users',
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
            sorter: true,
          },
          {
            title: 'Name',
            key: 'name',
            dataIndex: 'name',
            sorter: true,
          },
          {
            title: 'Role',
            key: 'type',
            dataIndex: 'type',
            sorter: true,
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
      this.fetchUserList()
    },
    methods: {
      fetchUserList (options) {
        this.loading = true

        let params = {
          page: 1,
          perPage: 10,
        }

        params = _.assign(params, options)

        this.$store.dispatch('user/getUserList', params).then(() => this.loading = false)
      },
      change (pagination, filters, sorter) {
        this.loading = true

        let params = {
          sort: sorter.field || 'updated_at',
          direction: this.sort[sorter.order] || 'desc',
          page: pagination.current,
          perPage: pagination.pageSize,
        }

        this.$store.dispatch('user/getUserList', params).then(() => this.loading = false)
      },
      routeToDetail (id) {
        this.$router.push({ name: 'userDetail', params: { id: id } })
      },
      onDelete (key) {
        this.$store.dispatch('user/deleteUser', key).then(() => this.fetchUserList())
      },
      search (searchKey) {
        const params = {
          name: searchKey,
        }
        this.fetchUserList(params)
      },
    },
  }
</script>

<style scoped>

</style>
