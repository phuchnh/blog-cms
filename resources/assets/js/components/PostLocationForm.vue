<template>
  <div class="form-group" :class="{ 'has-error': error }">
    <label for="location" class="col-sm-2 control-label">Location <span class="required">*</span></label>
    <div class="col-sm-10">
      <input v-validate="'required'" class="form-control" id="location" name="location"
             v-model="metaData.meta.location"/>
      <div class="help-block" v-if="errors.first('location')">
        <span>{{ errors.first('location') }}</span>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'PostLocationForm',
    props: ['metaData', 'error'],
    $_veeValidate: {
      // value getter
      value() {
        return this.item.location
      }
    },
    data () {
      return {
      }
    }
  }
</script>
