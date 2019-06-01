<template>
  <div class="col-sm-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Recent Subcriptions</h3>

      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <el-table
            :data="lists"
            v-loading="loading"
            border
            size="small"
            empty-text="No data"
            height="280"
        >
          <el-table-column prop="id" label="Id" min-width="30"/>
          <el-table-column prop="name" label="Name">
            <template slot-scope="scope">
              <a @click="goToDetail(scope.row.id)">{{ scope.row.name }}</a>
            </template>
          </el-table-column>
          <el-table-column prop="email" label="Email"/>
          <el-table-column
              label="Type"
              prop="type">
            <template slot-scope="scope">
              {{ scope.row.type | capitalize }}
            </template>
          </el-table-column>
          <el-table-column
              prop="status"
              label="Status">
            <template slot-scope="scope">
              <label v-if="scope.row.status === 1" class="label label-default">Read</label>
              <label v-else class="label label-success">New</label>
            </template>
          </el-table-column>
          <el-table-column prop="created_at" label="Created at"/>
        </el-table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</template>

<script>
  import store from '@/store'
  import { mapGetters, mapActions } from 'vuex'

  export default {
    name: 'RecentSubcription',
    computed: {
      ...mapGetters('subscription', ['recentSubscriptions']),
      lists () {
        return this.recentSubscriptions
      },
    },
    data () {
      return {
        loading: true,
      }
    },
    created () {
      store.dispatch('subscription/getRecentSubscription').then(() => {
        this.loading = false
      })
    },
    methods: {
      goToDetail (id) {
        this.$router.push({ name: 'SubscriptionDetail', params: { id: id } })
      },
    },
  }
</script>

<style scoped>
</style>