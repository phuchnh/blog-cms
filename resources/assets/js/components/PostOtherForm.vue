<template>
  <div class="box box-success">
    <div class="box-header">
      <div class="box-header with-border">
        <h3 class="box-title">Other Post</h3>
      </div>
    </div>

    <div class="box-body">
      <div class="form-group" :class="{ 'has-error': errors.first('location') }">
        <label for="other_post" class="col-sm-12 control-label">Location <span class="required">*</span></label>

        <div class="col-sm-12">
          <input class="form-control"
                 id="other_post"
                 name="other_post"
                 v-model="inputParam"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import _ from 'lodash'
  import { mapGetters } from 'vuex'

  export default {
    name: 'PostOtherForm',
    props: ['metaData'],
    computed: {
      ...mapGetters({
        posts: 'post/posts',
      }),
    },
    data () {
      return {
        item: this.metaData.meta ? this.metaData.meta : {},
        inputParam: '',
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
      inputParam (val) {
        this.onChangeInput(val, this)
      },
    },
    methods: {
      onChangeInput: _.debounce((val, $this) => {
        const params = {
          type: $this.item.type,
          title: val,
        }

        $this.$store.dispatch('post/getPostList', params).then(res => {
          console.log($this.posts)
        })
      }, 500),
    },
    beforeRouteLeave () {
      this.$store.dispatch('post/resetState')
    },
  }
</script>

<style scoped>

</style>