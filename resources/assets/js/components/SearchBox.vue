<template>
  <div>
    <form role="search" @submit.prevent="handleSubmit">
      <div class="row">
        <div class="form-inline col-xs-12 col-md-3">
          <label for="column">Column</label>
          {{ search.column }}
          <select class="form-control" style="width: 100%" id="column" v-model="search.column">
            <option v-for="(column, index) in columns"
                    :key="index"
                    :value="column | lowerCase"
                    :selected="search.column === column"> {{ column }}
            </option>
          </select>
        </div>
        <div class="form-group col-xs-12 col-md-6">
          <label for="keyword">Keyword</label>
          {{ search.keyword }}
          <input type="text" class="form-control" name="keyword" id="keyword" v-model="search.keyword">
        </div>
        <div class="col-xs-12 col-md-3" style="margin-top: 2.5rem">
          <button type="submit" class="btn btn-primary">Search</button>
          <button type="reset" @click="handleReset" class="btn btn-default">Reset</button>
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

    filters: {
      lowerCase (value) {
        return value.toLowerCase()
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
      handleReset () {
        this.search.column = this.columns[0].toLocaleLowerCase()
        this.search.keyword = null
        let obj = {}
        obj[this.search.column] = this.search.keyword
        this.$emit('change', obj)
      },

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