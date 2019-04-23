<template>
  <div class="form-group">
      <div class="col-sm-8">
        <p>{{ title }}</p>
      </div>

      <div class="col-sm-4">
        <el-switch v-model="status" class="pull-right"></el-switch>
      </div>
  </div>
</template>

<script>
  export default {
    name: 'PostDisplay',
    props: {
      value: {
        type: String | Object | Array,
      },
      title: {
        type: String,
      },
    },
    data () {
      return {
        status: this.value ? JSON.parse(this.value) : false
      }
    },
    watch: {
      /**
       * update value to parent
       * @param val
       */
      status: {
        deep: true,
        handler (val) {
          this.$emit('input', _.toString(val))
        },
      },
    },
  }
</script>

<style scoped>

</style>
