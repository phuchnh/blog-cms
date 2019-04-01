<template>
    <div class="box-body" v-if="posts">
        <button @click="$emit('routeToNew')" class="btn btn-primary" style="margin: 20px 0">Add New</button>
        <a-table bordered :dataSource="posts" :columns="columns" rowKey="id" :loading="loading">
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
  import {mapGetters} from 'vuex';
  export default {
    name: 'PostList',
    computed: {
      ...mapGetters({
        posts: 'post/posts'
      })
    },
    props: {
      type: String
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
            title: 'Title',
            key: 'title',
            dataIndex: 'title',
          },
          {
            title: 'Status',
            key: 'publish',
            dataIndex: 'publish',
            scopedSlots: { customRender: 'status' },
          },
          {
            title: 'Action',
            dataIndex: 'action',
            scopedSlots: { customRender: 'action' },
          }
        ]
      }
    },
    created() {
      this.fetchPostList();
    },
    methods: {
      fetchPostList() {
        this.loading = true;
        this.$store.dispatch('post/getPostList', this.type).then(() => this.loading = false);
      },
      onDelete (key) {
        this.$store.dispatch('post/deletePost', key).then(() => this.fetchPostList());
      },
    }
  };
</script>

<style scoped>

</style>
