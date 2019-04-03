<template>
  <div class="box box-widget">
    <!-- /.box-header -->
    <!-- /.box-header -->
    <!-- /.box-box-body -->
    <div class="box-body">
      <a-table :dataSource="faqs"
               :columns="columns"
               :rowKey="record => record.id"
               :loading="loading">
      </a-table>
    </div>
    <!-- /.box-box-body -->
    <!-- /.box-footer -->
    <div class="box-footer">
    </div>
    <!-- /.box-footer -->
  </div>
</template>

<script>
    import Vue from 'vue';
    import { Table } from 'ant-design-vue';

    Vue.use(Table);

    const columns = [
        { title: 'Slug', dataIndex: 'slug', key: 'slug' },
        { title: 'Title', dataIndex: 'title', key: 'title' },
        { title: 'Description', dataIndex: 'description', key: 'description' }
    ];

    import { mapState } from 'vuex';
    import { FaqService } from '../api';

    export default {
        name: 'FaqList',
        data() {
            return {
                loading: true,
                columns: columns
            };
        },
        computed: mapState({
            faqs: state => state.faq.data
        }),
        beforeRouteEnter(to, from, next) {
            let params = { page: 1, perPage: 10 };
            FaqService.fetchList(params).then(res => {
                const { data } = res.data;
                next(vm => {
                    vm.loading = false;
                    vm.$store.commit('faq/SET_FAQ', data);
                });
            });
        },
        beforeRouteUpdate(to, from, next) {
        },
        methods: {}
    };
</script>

<style scoped>

</style>