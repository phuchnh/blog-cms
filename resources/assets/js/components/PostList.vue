<template>
  <div class="box-body" v-if="posts">
    <div class="row">
      <div class="col-sm-12" style="margin-top: 20px">
        <div class="col-sm-6" style="padding: 0; float: left">
          <SearchForm @fetchList="fetchPostList" @search="search"></SearchForm>
        </div>
        <div class="col-sm-2 col-sm-offset-4 margin-bottom" style="padding-right: 0; display: block; overflow: auto">
          <button @click="$emit('routeToNew')" class="btn btn-primary pull-right">Add New</button>
        </div>
      </div>
    </div>

    <a-table bordered
             :dataSource="posts"
             :columns="columns"
             :rowKey="record => record.id"
             :loading="loading"
             :pagination="pagination"
             @change="change">
      <template slot="thumbnail" slot-scope="text, record">
        <img :src="record.thumbnail" height="50" width="auto">
      </template>

      <template slot="status" slot-scope="text, record">
        {{text ? 'Publish' : 'Draft'}}
      </template>
      <template slot="action" slot-scope="text, record">
        <a-button @click="$emit('edit', record.id)">Edit</a-button>
        <a-popconfirm
            v-if="posts.length"
            title="Are you sure to delete?"
            @confirm="onDelete(record.id)">
          <a-button type="danger">Delete</a-button>
        </a-popconfirm>
      </template>
    </a-table>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import SearchForm from './SearchForm'

  export default {
    name: 'PostList',
    components: { SearchForm },
    computed: {
      ...mapGetters('post', {
        posts: 'posts',
        pagination: 'pagination',
      }),
    },
    props: {
      type: String,
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
            title: 'Thumbnail',
            dataIndex: 'thumbnail',
            scopedSlots: { customRender: 'thumbnail' },
          },
          {
            title: 'Title',
            key: 'title',
            dataIndex: 'title',
            sorter: true,
          },
          {
            title: 'Status',
            key: 'publish',
            dataIndex: 'publish',
            sorter: true,
            scopedSlots: { customRender: 'status' },
          },
          {
            title: 'Action',
            dataIndex: 'action',
            scopedSlots: { customRender: 'action' },
          },
        ],
      }
    },
    created () {
      this.fetchPostList()
    },
    methods: {
      fetchPostList (options) {
        this.loading = true

        let params = {
          page: 1,
          perPage: 10,
          type: this.type,
        }

        params = _.assign(params, options)

        this.$store.dispatch('post/getPostList', params).then(() => this.loading = false)
      },
      onDelete (key) {
        this.$store.dispatch('post/deletePost', key).then(() => this.fetchPostList())
      },
      change (pagination, filters, sorter) {
        this.loading = true

        let params = {
          sort: sorter.field || 'updated_at',
          direction: this.sort[sorter.order] || 'desc',
          page: pagination.current,
          perPage: pagination.pageSize,
          type: this.type
        }

        this.$store.dispatch('post/getPostList', params).then(() => this.loading = false)
      },
      search (searchKey) {
        const params = {
          title: searchKey
        };
        this.fetchPostList(params)
      }
    },
  }
</script>

<style scoped>

</style>
