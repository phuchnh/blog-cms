<template>
  <div class="form-group">
      <div class="col-sm-8">
        <p>{{ title }}</p>
      </div>

      <div class="col-sm-4">
        <a-switch v-model="status" class="pull-right"/>
      </div>
  </div>
</template>

<script>
  export default {
    name: 'PostDisplay',
    props: ['metaData', 'metaType', 'title'],
    data () {
      return {
        status: false,
      }
    },
    watch: {
      /**
       * update value to parent
       * @param val
       */
      status (val) {
        this.metaData.meta[this.metaType] = val.toString()
      },
      metaData (val) {
        this.item = val.meta ? val.meta : {}

        if (_.has(this.item, this.metaType)) {
          this.status = this.item[this.metaType] === 'true' ? true : false
        }
      },
    },
  }
</script>

<style scoped>

</style>