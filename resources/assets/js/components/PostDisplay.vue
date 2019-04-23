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
    // watch: {
    //   /**
    //    * update value to parent
    //    * @param val
    //    */
    //   status (val) {
    //     this.metaData.meta[this.metaType] = val.toString()
    //   },
    //   metaData (val) {
    //     this.item = val.meta ? val.meta : {}
    //
    //     if (_.has(this.item, this.metaType)) {
    //       this.status = this.item[this.metaType] === 'true' ? true : false
    //     }
    //   },
    // },
  }
</script>

<style scoped>

</style>
