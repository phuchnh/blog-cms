<template>
  <div class="form-group">
    <div class="col-sm-8">
      <p>{{ title }}</p>
    </div>

    <div class="col-sm-4">
      <el-switch
          v-model="status"
          class="pull-right"
          active-value="1"
          inactive-value="0"
      >
      </el-switch>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'PostDisplay',
    props: {
      value: {
        type: Number | Object | Array,
      },
      title: {
        type: String,
      },
    },
    data () {
      return {
        status: _.toString(this.value),
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
          this.$emit('input', parseInt(val))
        },
      },
    },
  }
</script>

<style scoped>

</style>
