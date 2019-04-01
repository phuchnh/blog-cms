<template>
    <div class="box box-widget">
        <!-- /.box-header -->
        <!-- /.box-header -->
        <!-- /.box-box-body -->
        <div class="box-body">
            <a-table :columns="columns" :dataSource="data" bordered>
                <template slot="name" slot-scope="text">
                    <a href="javascript:void(0)">{{text}}</a>
                </template>
                <template slot="title" slot-scope="currentPageData">
                    Header
                </template>
                <template slot="footer" slot-scope="currentPageData">
                    Footer
                </template>
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

    const columns = [{
        title: 'Name',
        dataIndex: 'name',
        scopedSlots: { customRender: 'name' },
    }, {
        title: 'Cash Assets',
        className: 'column-money',
        dataIndex: 'money',
    }, {
        title: 'Address',
        dataIndex: 'address',
    }];

    const data = [{
        key: '1',
        name: 'John Brown',
        money: '￥300,000.00',
        address: 'New York No. 1 Lake Park',
    }, {
        key: '2',
        name: 'Jim Green',
        money: '￥1,256,000.00',
        address: 'London No. 1 Lake Park',
    }, {
        key: '3',
        name: 'Joe Black',
        money: '￥120,000.00',
        address: 'Sidney No. 1 Lake Park',
    }];
    export default {
        name: 'FaqList',
        data() {
            return {
                data,
                columns,
            }
        }
    };
</script>

<style scoped>

</style>