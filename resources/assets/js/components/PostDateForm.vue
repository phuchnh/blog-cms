<template>
  <div>
    <div class="form-group" :class="{ 'has-error': errors.first('date') }">
      <label class="col-sm-2 control-label">Date <span class="required">*</span></label>
      <div class="col-sm-8">
        <a-date-picker v-model="item.date" name="date"  v-validate="'required'" />
        <div class="help-block" v-if="errors.first('date')">
          {{ errors.first('date') }}
        </div>
      </div>
    </div>
    <div class="form-group" :class="{ 'has-error': errors.first('start_time') }">
      <label class="col-sm-2 control-label">Start time <span class="required">*</span></label>
      <div class="col-sm-8">
        <a-time-picker use12Hours format="h:mm:ss A" name="start_time" v-model="item.start_time" v-validate="'required'" />
        <div class="help-block" v-if="errors.first('start_time')">
          {{ errors.first('start_time') }}
        </div>
      </div>
    </div>
    <div class="form-group" :class="{ 'has-error': errors.first('end_time') }">
      <label class="col-sm-2 control-label">End time <span class="required">*</span></label>
      <div class="col-sm-8">
        <a-time-picker use12Hours format="h:mm:ss A" name="end_time" v-model="item.end_time" v-validate="'required'" />
        <div class="help-block" v-if="errors.first('end_time')">
          {{ errors.first('end_time') }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import moment from 'moment'

  export default {
    inject: ['$validator'],
    name: 'PostDateForm',
    props: ['metaData', 'formAction'],
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
      metaData (val) {
        if (this.formAction === 'edit') {
          this.metaData.meta.date = this.metaData.meta.date ? moment(this.metaData.meta.date) : null
          this.metaData.meta.start_time = this.metaData.meta.start_time ? moment(this.metaData.meta.start_time) : null
          this.metaData.meta.end_time = this.metaData.meta.end_time ? moment(this.metaData.meta.end_time) : null
          this.item = this.metaData.meta
        }

      },
    }
  }
</script>

<style scoped>

</style>
