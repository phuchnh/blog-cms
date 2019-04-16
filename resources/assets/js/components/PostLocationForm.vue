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

        this.$emit('item', this.metaData)
      },
      metaData (val) {
        this.item = val.meta ? val.meta : {}
      },
    },
  }
</script>
