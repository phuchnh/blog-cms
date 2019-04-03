<template>
    <div>
        <!-- Content Header (Page header) -->
        <PageHeader :title="'Clients'"></PageHeader>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box">
                <div class="box-body">
                    <button @click="routeToNew" class="btn btn-primary" style="margin: 20px 0">Add New</button>
                    <a-table bordered :dataSource="clients" :columns="columns" rowKey="id" :loading="loading">
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
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
  import PageHeader from '../components/PageHeader';
  import {mapGetters} from 'vuex';
  export default {
    name: 'ClientList',
    components: {PageHeader},
    computed: {
      ...mapGetters({
        clients: 'client/clients'
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
                title: 'Action',
                dataIndex: 'action',
                scopedSlots: { customRender: 'action' },
              }
              ]
      }
    },
    mounted() {
      this.fetchClientList();
    },
    methods: {
      fetchClientList() {
        this.loading = true;
        this.$store.dispatch('client/getClientList', this.type).then(() => this.loading = false);
      },
      onDelete (key) {
        this.$store.dispatch('client/deleteClient', key).then(() => this.fetchClientList());
      },
      routeToDetail(id) {
        this.$router.push({name: 'clientDetail', params: {id: id}});
      },
      routeToNew() {
        this.$router.push({name: 'clientNew'});
      }
    }
  };
</script>

<style scoped>

</style>
