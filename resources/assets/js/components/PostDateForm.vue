<template>
  <div class="form-group">
    <label class="col-sm-2 control-label">Event</label>
    <div class="col-sm-8">
      <a-date-picker
          showTime
          format="YYYY-MM-DD HH:mm:ss"
          placeholder="Select Time"
          v-model="item.date"
      />
      <!--<p> {{ item.date | convertDateTime('YYYY-MM-DD HH:mm:ss') }}</p>-->
    </div>
  </div>
</template>

<script>
  import moment from 'moment'

  export default {
    name: 'PostDateForm',
    props: ['metaData'],
    data () {
      return {
        item: this.metaData.meta ? this.metaData.meta : {},
      }
    },
    watch: {
      /**
       * update value to parent
       * @param val
       */
      item (val) {
        this.metaData.meta = val

        this.metaData.meta.date = moment(val.date)

        this.$emit('item', this.metaData)
      },
      metaData (val) {
        this.item = val.meta ? val.meta : {}
      },
    },
  }
</script>

<style scoped>

</style>