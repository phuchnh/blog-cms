<template>
  <div>
    <form role="searchbox" @submit.prevent="handleSubmit">
      <div class="row">
        <div class="form-inline col-xs-12 col-md-3">
          <label for="column">Column</label>
          <select class="form-control" style="width: 100%" id="column" v-model="search.column">
            <option v-for="(column, index) in columns" :key="index" :value="column"> {{ column }}</option>
          </select>
        </div>
        <div class="form-group col-xs-12 col-md-6">
          <label for="keyword">Keyword</label>
          <input type="text" class="form-control" name="keyword" id="keyword" v-model="search.keyword">
        </div>
        <div class="col-xs-12 col-md-3" style="margin-top: 2.5rem">
          <button type="submit" class="btn btn-primary">Search</button>
          <button type="reset" class="btn btn-default">Reset</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
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

    data () {
      return {
        search: {
          column: '',
          keyword: '',
        },
      }
    },

    methods: {
      handleSubmit () {
        this.search.column = this.search.column.toLocaleLowerCase()
        let obj = {}
        obj[this.search.column] = this.search.keyword
        this.$emit('change', obj)
      },
    },
  }
</script>

<style scoped>

</style>