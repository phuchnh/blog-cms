<template>
  <div class="box box-widget">
    <div class="box-header">
      <h3 class="box-title text-capitalize">{{ title }}</h3>
    </div>
    <div class="box-body">
      <div class="clearfix">
        <a-upload
            name="files"
            :action="action"
            :headers="headers"
            listType="picture-card"
            :defaultFileList="fileList"
            :remove="handleRemove"
            @preview="handlePreview"
            @change="handleChange"
        >
          <div v-if="fileList.length < 3">
            <a-icon type="plus"/>
            <div class="ant-upload-text">Upload</div>
          </div>
        </a-upload>
        <a-modal :visible="previewVisible" :footer="null" @cancel="handleCancel">
          <img alt="example" style="width: 100%" :src="previewImage"/>
        </a-modal>
        >>>>>>> feature/edit_upload_image
      </div>
    </div>
  </div>
</template>

<script>
  import { Cookie } from '@/util'

  export default {
    name: 'PostMetaImageForm',
    props: {
      value: {
        type: String | Object | Array,
      },
      boxTitle: {
        type: String,
      },
    },
    data () {
      return {
        previewVisible: false,
        previewImage: '',
        fileList: this.value || [],
      }
    },
    computed: {
      action () {
        return '/api/assets'
      },
      headers () {
        return {
          'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Authorization': 'Bearer ' + Cookie.findByName('token'),
        }
      },
    },
    watch: {
      /**
       * update value to parent
       * @param val
       */
      imgUrl: {
        deep: true,
        handler (val) {
          this.$emit('input', val)
        },
      },
    },
    methods: {
      handleCancel () {
        this.previewVisible = false
      },

      handleRemove (file) {
        console.log(file)
        debugger
      },

      handlePreview (file) {
        this.previewImage = file.url || file.thumbUrl
        this.previewVisible = true
      },

      handleChange (info) {

        let fileList = info.fileList

        // 1. Read from response and show file link
        fileList = fileList.map((file) => {
          if (file.response) {
            file.url = file.response.data[0].uri
            file.uid = file.response.data[0].id
          }
          return file
        })

        // 2. Filter successfully uploaded files according to response from server
        fileList = fileList.filter((file) => {
          if (file.response) {
            return file.response.status === 'success'
          }
          return false
        })

        this.fileList = [...fileList]
      },

      addFileList (name, url) {
        this.fileList.push({
          uid: +new Date(),
          name: name,
          status: 'done',
          url: url,
          thumbUrl: url,
        })
      },

      handleAfterUpload (response) {
        const { data } = response
        return data[0].uri
      },
      
      beforeUpload (file) {
        const isLt2M = file.size / 1024 / 1024 < 2
        if (!isLt2M) {
          this.$message.error('Image must smaller than 2MB!')
        }
        return isLt2M
      },
      resetData () {
        this.fileInput = null
      },
    },
  }
</script>

<style scoped lang="scss">
  /* you can make up upload button and sample style by using stylesheets */
  .ant-upload-select-picture-card i {
    font-size: 32px;
    color: #999;
  }

  .ant-upload-select-picture-card .ant-upload-text {
    margin-top: 8px;
    color: #666;
  }
</style>
