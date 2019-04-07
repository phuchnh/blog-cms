<template>
  <div class="form-group" :class="{ 'has-error': error }">
    <label for="location" class="col-sm-2 control-label">Location <span class="required">*</span></label>
    <div class="col-sm-8">
      <input class="form-control" id="location" name="location"
             v-model="item.location" @input="$emit('input', $event.target.value)" />
      <div class="help-block">
        {{ error }}
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

<style scoped>

</style>