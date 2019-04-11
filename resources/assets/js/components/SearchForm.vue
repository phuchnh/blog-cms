<template>
  <form class="form-horizontal" @submit.prevent="$emit('search', searchKey)" @reset.prevent="reset">
    <div class="form-group">
      <div class="col-sm-9 margin-bottom">
        <div class="input-group input-group-md">
          <input placeholder="Search..." class="form-control" id="name" name="name" v-model="searchKey"/>
          <span class="input-group-btn">
                  <button type="submit" class="btn btn-success">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
        </div>
      </div>
      <div class="col-sm-2 margin-bottom">
        <button type="reset" class="btn btn-danger reset-btn">
          Reset
        </button>
      </div>
    </div>
  </form>
</template>

<script>
  export default {
    name: 'SearchForm',
    data () {
      return {
        searchKey: null
      }
    },
    methods: {
      reset () {
        this.searchKey = null
        this.$emit('fetchList')
      }
    }
  }
</script>

<style scoped>
  @media (max-width: 767px) {
    .reset-btn {
      float: right;
    }
  }
</style>
