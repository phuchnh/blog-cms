<template>
    <div class="box box-widget">
        <!-- /.box-header -->
        <!-- /.box-header -->
        <!-- /.box-box-body -->
        <div class="box-body">
            <pre>{{ faqs }}</pre>
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

    const columns = [{
        title: 'Name',
        dataIndex: 'name',
        scopedSlots: { customRender: 'name' }
    }, {
        title: 'Cash Assets',
        className: 'column-money',
        dataIndex: 'money'
    }, {
        title: 'Address',
        dataIndex: 'address'
    }];


    import { mapState } from 'vuex';

    export default {
        name: 'FaqList',
        computed: mapState({
            faqs: state => state.faq.data
        }),
        beforeRouteEnter(to, from, next) {
            let params = {
                page: 1,
                perPage: 10,
            };
            next(
                vm => vm.$store.dispatch('faq/fetchFaqList', params)
            );
        },
        beforeRouteUpdate(to, from, next) {
        },
        methods: {}
    };
</script>

<style scoped>

</style>