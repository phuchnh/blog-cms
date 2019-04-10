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
            <template v-for="(tag, index) in tagData.tag">
              <a-tag :key="tag.name" closable :afterClose="() => handleClose(tag.name)">
                {{tag.name}}
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
        inputVisible: false,
        inputValue: '',
      }
    },
    watch: {},
    methods: {
      /**
       * Submit & filter after delete tag
       */
      handleClose (removedTag) {
        let tags = _.map(this.tagData.tag, 'name')

        this.tagData.tag = this.transformData(tags.filter(tag => tag !== removedTag))
      },

      /**
       * Show input box
       */
      showInput () {
        this.inputVisible = true
        this.$nextTick(function () {
          this.$refs.input.focus()
        })
      },

      handleInputChange (e) {
        this.inputValue = e.target.value
      },

      /**
       * Submit data after input finish
       */
      handleInputConfirm () {
        const inputValue = this.inputValue
        let tags = this.tagData.tag

        // filter tags
        if (inputValue && _.map(tags, 'name').indexOf(inputValue) === -1) {
          this.tagData.tag = [...tags, this.transformData(new Array(inputValue))[0]]
        }

        Object.assign(this, {
          inputVisible: false,
          inputValue: '',
        })
      },
      /**
       * transform tag to array
       * @param tags
       * @returns {Array}
       */
      transformData (tags) {
        let ArrayData = []

        if (tags) {
          ArrayData = _.map(tags, (item) => {
            return {
              type: 'tag',
              position: 0,
              real_depth: 0,
              name: item,
            }
          })
        }

        return ArrayData
      },
    },
  }
</script>

<style scoped>

</style>
