<template xmlns="http://www.w3.org/1999/html">
  <div id="PostMetaForm" class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Meta Section</h3>
    </div>
    <!-- /.box-header -->

    <!-- form start -->
    <div class="box-body">
      <div class="form-group">
        <label for="meta_title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
          <input v-validate="'required'" class="form-control" id="meta_title" name="meta_title"
                 v-model="item.title"/>
        </div>
      </div>
      <div class="form-group">
        <label for="meta_keywords" class="col-sm-2 control-label">Keywords</label>
        <div class="col-sm-10">
          <input class="form-control" id="meta_keywords" name="meta_keywords"
                 v-model="item.keywords"/>
        </div>
      </div>
      <div class="form-group">
        <label for="meta_description" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
          <textarea class="form-control" id="meta_description" name="meta_description"
                    v-model="item.description">
          </textarea>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'PostMetaForm',
    props: {
      value: {
        type: String | Object | Array,
        default: '',
      },
      locale: {
        type: String,
        default: 'en',
      },
    },
    data () {
      return {
        item: !_.isEmpty(this.value) ? JSON.parse(this.value) : {},
      }
    },
    watch: {
      /**
       * update value to parent
       * @param val
       */
      item: {
        deep: true,
        handler (val) {
          this.$emit('input', JSON.stringify({ ...val }))
        },
      },
    },
  }
</script>
