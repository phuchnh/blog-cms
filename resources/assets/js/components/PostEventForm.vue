<template>
  <div class="box box-widget">
    <div class="box-header">
      <h3 class="box-title">Events</h3>
    </div>
    <div class="box-body">
      <form action="">
        <fieldset>
          <div class="form-group" :class="{ 'has-error': errors.first('date') }">
            <label>Date <span class="required">*</span></label>
            <el-date-picker
                v-model="event.date"
                type="date"
                name="date"
                placeholder="Pick a day"
                v-validate="'required'"
                style="width: 100%;"
            >
            </el-date-picker>
            <div class="help-block" v-if="errors.first('date')">
              {{ errors.first('date') }}
            </div>
          </div>
          <div class="form-group" :class="{ 'has-error': errors.first('start_time') }">
            <label>Start time <span class="required">*</span></label>
            <el-time-picker
                format="hh:mm:ss A"
                v-model="event.start_time"
                placeholder="Pick start time"
                name="start_time"
                v-validate="'required'"
                style="width: 100%;"
            >
            </el-time-picker>
            <div class="help-block" v-if="errors.first('start_time')">
              {{ errors.first('start_time') }}
            </div>
          </div>
          <div class="form-group" :class="{ 'has-error': errors.first('end_time') }">
            <label>End time <span class="required">*</span></label>
            <el-time-picker
                format="hh:mm:ss A"
                v-model="event.end_time"
                placeholder="Pick end time"
                name="end_time"
                v-validate="'required'"
                style="width: 100%;"
            >
            </el-time-picker>
            <div class="help-block" v-if="errors.first('end_time')">
              {{ errors.first('end_time') }}
            </div>
          </div>
          <div class="form-group" :class="{ 'has-error': errors.first('location') }">
            <label for="location">Location <span class="required">*</span></label>
            <textarea name="location"
                      id="location"
                      class="form-control"
                      style="min-height: 100px"
                      v-model="event.location"
                      v-validate="'required'"
            >
            </textarea>
            <div class="help-block" v-if="errors.first('location')">
              {{ errors.first('location') }}
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</template>

<script>

  export default {
    inject: ['$validator'],
    name: 'PostEventForm',
    props: ['value'],
    data () {
      return {
        event: this.value,
      }
    },

    created () {
      this.event = this.defaultEvent()
    },

    watch: {
      event (newValue, oldValue) {
        if (newValue !== oldValue) {
          this.$emit('input', newValue)
        }
      },
    },

    methods: {
      defaultEvent () {
        const event = {
          date: '',
          start_time: '',
          end_time: '',
          location: '',
        }

        return _.assign({}, event, this.event)
      },
    },
  }
</script>

<style scoped>

</style>
