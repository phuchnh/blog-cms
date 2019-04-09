<template>
  <div class="box-body" v-if="posts">
    <button @click="$emit('routeToNew')" class="btn btn-primary" style="margin: 20px 0">Add New</button>
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

  export default {
    name: 'PostList',
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
      fetchPostList () {
        this.loading = true

        let params = {
          page: 1,
          perPage: 10,
          type: this.type,
        }

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
    },
  }
</script>

<style scoped>

</style>
