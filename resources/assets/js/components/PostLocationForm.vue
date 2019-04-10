<template>
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
</template>

<script>
  export default {
    inject: ['$validator'],
    name: 'PostLocationForm',
    props: ['metaData'],
    data () {
      return {
      }
    }
  }
</script>
