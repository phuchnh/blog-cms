<template>
  <div>
    <form role="search" @submit.prevent="handleSubmit">
      <div class="row">
        <div class="form-inline col-xs-12 col-lg-3">
          <label for="column">Column</label>
          <select class="form-control" style="width: 100%" id="column" v-model="search.column">
            <option v-for="(column, index) in columns"
                    :key="index"
                    :value="column | snakeCase"
                    :selected="search.column === column"> {{ column }}
            </option>
          </select>
        </div>
        <div class="form-inline col-xs-12 col-lg-3">
          <label for="search_mode">Mode</label>
          <select class="form-control" style="width: 100%" id="search_mode" v-model="search.mode">
            <option v-for="(mode, index) in modes"
                    :key="index"
                    :value="mode | snakeCase"
                    :selected="search.mode === mode"> {{ mode }}
            </option>
          </select>
        </div>
        <div class="form-group col-xs-12 col-lg-4">
          <label for="keyword">Keyword</label>
          <input type="text" class="form-control" name="keyword" id="keyword" v-model="search.keyword">
        </div>
        <div class="col-xs-12 col-lg-2" style="margin-top: 2.5rem">
          <button type="submit" class="btn btn-primary">Search</button>
          <button type="reset" @click="handleReset" class="btn btn-default">Reset</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  import * as _ from 'lodash'

  export default {
    name: 'SearchBox',
    props: {
      columns: {
        type: Array,
        default () {
          return ['Title', 'Slug']
        },
      },
    },

    filters: {
      snakeCase (value) {
        return _.snakeCase(value)
      },
    },

    data () {
      return {
        modes: [
          'Contain',
          'Exactly',
          'Starts with',
          'Ends with',
        ],
        search: {
          column: '',
          keyword: '',
          mode: '',
        },
      }
    },

    created () {
      this.search.column = this.columns[0].toLocaleLowerCase()
      this.search.mode = this.modes[0].toLocaleLowerCase()

    },

    methods: {
      handleReset () {
        this.search.column = this.columns[0].toLocaleLowerCase()
        this.search.mode = this.modes[0].toLocaleLowerCase()
        this.search.keyword = null

        let obj = {}
        obj[this.search.column] = this.search.keyword
        obj['mode'] = this.search.mode

        this.$emit('change', obj)
      },

      handleSubmit () {
        let obj = {}
        obj[this.search.column] = this.search.keyword
        obj['mode'] = this.search.mode
        this.$emit('change', obj)
      },
    },
  }
</script>

<style scoped>

</style>
