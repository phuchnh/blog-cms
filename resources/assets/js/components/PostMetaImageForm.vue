<template>
  <div>
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
              listType="picture"
              v-model="images"
              :remove="handleRemove"
              @preview="handlePreview"
              @change="handleChange"
          >
            <a-button v-if="images.length < 2">
              <a-icon type="upload"/>
              Upload
            </a-button>
          </a-upload>
          <a-modal :visible="previewVisible" :footer="null" @cancel="handleCancel" :title="previewImage.name">
            <img alt="example" class="img" :src="previewImage.url"/>
          </a-modal>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { Cookie } from '@/util'
  import { ApiService } from '../api'

  export default {
    name: 'PostMetaImageForm',
    props: ['value', 'title'],
    data () {
      return {
        images: [],
        previewVisible: false,
        previewImage: {
          name: '',
          url: '',
        },
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
    created () {
      if (this.value) {
        this.images = [...this.value]
      }
    },
    watch: {
      images (newValue, oldValue) {
        if (newValue !== oldValue) {
          this.$emit('input', newValue)
        }
      },
    },
    methods: {
      handleCancel () {
        this.previewVisible = false
      },

      handleRemove (file) {
        return ApiService.delete(`/assets/${ file.uid }`).then(
          () => true,
          () => false,
        )
      },

      handlePreview (file) {
        this.previewImage.name = file.name
        this.previewImage.url = file.url
        this.previewVisible = true
      },

      handleChange (info) {

        let fileList = [...info.fileList]

        let images = []

        // 1. Read from response and show file link
        images = fileList.map((file) => {
          if (file.response) {
            file.url = file.response.data[0].uri
            file.uid = file.response.data[0].id
          }
          return file
        })

        // 2. Filter successfully uploaded files according to response from server
        images = fileList.filter((file) => {
          if (file.response) {
            return file.response.status === 'success'
          }
          return false
        })

        images = fileList.map((file) => {
          return {
            id: file.uid,
            name: file.name,
            status: 'done',
            url: file.url,
          }
        })

        this.images = _.assign([], this.images, [...images])
      },

      addFileList (name, url) {
        this.fileList.push({
          uid: +new Date(),
          name: name,
          status: 'done',
          url: url,
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

  .img {
    width: 100%;
    object-fit: contain;
  }
</style>
