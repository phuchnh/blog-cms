<template>
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Tag Section</h3>
    </div>
    <!-- /.box-header -->

    <!-- form start -->
    <div class="box-body">
      <div class="form-group">
        <label class="col-sm-2 control-label">Tags</label>
        <div class="col-sm-10">
         <div class="form-control" style="overflow: auto; height: 100%">
           <template v-for="(tag, index) in tags">
             <a-tag :key="tag" closable :afterClose="() => handleClose(tag)">
               {{tag}}
             </a-tag>
           </template>
           <a-input
               v-if="inputVisible"
               ref="input"
               type="text"
               size="small"
               :style="{ width: '150px' }"
               :value="inputValue"
               @change="handleInputChange"
               @blur="handleInputConfirm"
               @keyup.enter="handleInputConfirm"
           />
           <a-tag v-else @click="showInput" style="background: #fff; borderStyle: dashed;">
             <a-icon type="plus"/>
             New Tag
           </a-tag>
         </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'TagForm',
    props: ['tagData'],
    data () {
      return {
        tags: this.tagData.tag ? this.tagData.tag : [],
        inputVisible: false,
        inputValue: '',
      }
    },
    watch: {
      /**
       * update value to parent
       * @param val
       */
      tags (val) {
        this.tagData.tag = this.transformData(val)
        this.$emit('tags', this.tagData)

      },
      tagData (val) {
        this.tags = val.tag ? val.tag : {}
      },
    },
    methods: {
      handleClose (removedTag) {
        this.tags = this.tags.filter(tag => tag !== removedTag)
      },

      showInput () {
        this.inputVisible = true
        this.$nextTick(function () {
          this.$refs.input.focus()
        })
      },

      handleInputChange (e) {
        this.inputValue = e.target.value
      },

      handleInputConfirm () {
        const inputValue = this.inputValue
        let tags = this.tags
        if (inputValue && tags.indexOf(inputValue) === -1) {
          tags = [...tags, inputValue]
        }
        Object.assign(this, {
          tags,
          inputVisible: false,
          inputValue: '',
        })
      },
      transformData(tags) {
        let ArrayData = []

        if (tags) {
          ArrayData = _.map(tags, (item) => {
            return {
              type: 'tag',
              position: 0,
              real_depth: 0,
              name: item
            }
          });
        }

        return ArrayData
      }
    },
  }
</script>

<style scoped>

</style>
