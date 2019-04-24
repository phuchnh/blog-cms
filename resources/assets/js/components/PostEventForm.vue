<template>
  <div>
    <div class="form-group" :class="{ 'has-error': errors.first('date') }">
      <label class="col-sm-2 control-label">Date <span class="required">*</span></label>
      <div class="col-sm-10">
        <el-date-picker
            v-model="item.date"
            type="date"
            name="date"
            placeholder="Pick a day"
            v-validate="'required'">
        </el-date-picker>
        <div class="help-block" v-if="errors.first('date')">
          {{ errors.first('date') }}
        </div>
      </div>
    </div>
    <div class="form-group" :class="{ 'has-error': errors.first('start_time') }">
      <label class="col-sm-2 control-label">Start time <span class="required">*</span></label>
      <div class="col-sm-10">
        <el-time-picker
            format="hh:mm:ss A"
            v-model="item.start_time"
            placeholder="Pick start time"
            name="start_time"
            v-validate="'required'">
        </el-time-picker>
        <div class="help-block" v-if="errors.first('start_time')">
          {{ errors.first('start_time') }}
        </div>
      </div>
    </div>
    <div class="form-group" :class="{ 'has-error': errors.first('end_time') }">
      <label class="col-sm-2 control-label">End time <span class="required">*</span></label>
      <div class="col-sm-10">
        <el-time-picker
            format="hh:mm:ss A"
            v-model="item.end_time"
            placeholder="Pick end time"
            name="end_time"
            v-validate="'required'">
        </el-time-picker>
        <div class="help-block" v-if="errors.first('end_time')">
          {{ errors.first('end_time') }}
        </div>
      </div>
    </div>
    <div class="form-group" :class="{ 'has-error': errors.first('location') }">
      <label for="location" class="col-sm-2 control-label">Location <span class="required">*</span></label>
      <div class="col-sm-10">
        <input class="form-control" id="location" name="location"
               v-model="item.location" v-validate="'required'" />
        <div class="help-block" v-if="errors.first('location')">
          {{ errors.first('location') }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    inject: ['$validator'],
    name: 'PostEventForm',
    props: {
      value: String | Object | Array
    },
    data () {
      return {
        item: !_.isEmpty(this.value) ? this.value : {},
      }
    },
    watch: {
      /**
       * update value to parent
       * @param val
       */
      item: {
        deep: true,
        handler (val) {
          this.$emit('input', val)
        },
      },
    },
  }
</script>

<style scoped>

</style>
