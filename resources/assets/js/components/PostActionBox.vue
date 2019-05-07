<template>
  <div class="button-section-fixed">
    <div class="form-group text-center">
      <div class="col-sm-12">
        <button v-for="(action, index) in actions" :key="index" type="button" class="btn btn-sm margin-r-5"
                :class="action.type"
                @click="onClick(action)"
                :disabled="disable && action.title !== 'Cancel'"
        >
          <i :class="action.icon"></i> {{ action.title | capitalize }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
  import * as _ from 'lodash'

  export default {
    name: 'PostActionBox',
    props: {
      actions: {
        type: Array,
        default () {
          return [
            {
              title: 'Cancel',
              icon: 'fa fa-times',
              type: 'btn-default',
            },
            {
              title: 'Save',
              icon: 'fa fa-save',
              type: 'btn-success',
            },
            {
              title: 'Publish',
              icon: 'fa fa-save',
              type: 'btn-success',
            },
          ]
        },
      },
      disable: {
        type: Boolean,
        default: false
      }
    },
    created () {
      if (this.value) {
        this.actions = [...this.customs]
      }
    },
    methods: {
      onClick (action) {
        this.$emit('click', _.snakeCase(action.title))
      },
    },
  }
</script>

<style scoped>

</style>
