<template>
    <div class="box">
        <div class="box-body">
            <a-table bordered :dataSource="users" :columns="columns" rowKey="id" :loading="loading">
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
  import {mapGetters} from 'vuex';
  export default {
    name: 'UserList',
    title: 'User List',
    computed: {
      ...mapGetters({
        users: 'user/users'
      })
    },
    data() {
      return {
          loading: true,
          columns: [
              {
                title: 'Id',
                key: 'id',
                dataIndex: 'id',
              },
              {
                title: 'Name',
                key: 'name',
                dataIndex: 'name',
              },
              {
                title: 'Role',
                key: 'type',
                dataIndex: 'type',
              },
              {
                title: 'Action',
                dataIndex: 'action',
                scopedSlots: { customRender: 'action' },
              }
          ]
      }
    },
    mounted() {
      this.fetchUserList();
    },
    methods: {
      fetchUserList() {
        this.loading = true;
        this.$store.dispatch('user/getUserList').then(() => this.loading = false);
      },
      routeToDetail(id) {
        this.$router.push({name: 'userDetail', params: {id: id}});
      },
      onDelete (key) {
        this.$store.dispatch('user/deleteUser', key).then(() => this.fetchUserList());
      },
    }
  };
</script>

<style scoped>

</style>
