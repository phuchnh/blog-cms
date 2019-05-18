<template>
  <div class="box box-widget">
    <div class="box-header" v-if="boxTitle">
      <h3 class="box-title text-capitalize">{{ boxTitle }}</h3>
    </div>
    <div class="box-body">
      <div class="clearfix">
        <a-upload
            name="files"
            :action="action"
            :headers="headers"
            listType="picture"
            v-model="images"
            :defaultFileList="images"
            :remove="handleRemove"
            @preview="handlePreview"
            @change="handleChange"
        >
          <a-button v-if="disable">
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
</template>

<script>
  import { Cookie } from '@/util'
  import { ApiService } from '../api'
  import * as _ from 'lodash'

  export default {
    name: 'ImagesBox',
    props: {
      value: {
        type: Object | Array,
        default: 0,
      },
      boxTitle: {
        type: String,
        default: '',
      },
      limit: {
        type: Number,
        default: 1,
      },
    },
    data () {
      return {
        images: [],
        previewVisible: false,
        previewImage: {
          name: '',
          url: '',
        },
        uploading: false
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

      disable () {
        return this.images.length < this.limit
      },
    },

    created () {
      if (_.isPlainObject(this.value)) {
        this.images = _.assign([], this.images, [this.value])
      }

      if (_.isArray(this.value)) {
        this.images = _.assign([], this.images, this.value)
      }
    },

    watch: {
      images (newValue, oldValue) {
        if (newValue !== oldValue) {
          if (newValue.length === 1) {
            this.$emit('input', newValue[0])
          }  else {
            this.$emit('input', newValue)
          }
        }
      },
      uploading (newValue, oldValue) {
        if (newValue !== oldValue) {
          this.$emit('uploading', newValue)
        }
      }
    },

    methods: {
      handleCancel () {
        this.previewVisible = false
      },

      handleRemove (file) {
        return ApiService.delete(`/assets/${ file.uid }`).then(
          () => {
            const newImages = this.images.filter((image) => file.uid !== image.id)
            if (newImages) {
              this.images = [...newImages]
            }
            return true
          },
          () => false,
        )
      },

      handlePreview (file) {
        this.previewImage.name = file.name
        this.previewImage.url = file.url
        this.previewVisible = true
      },

      handleChange (info) {
        if (info.file.status === 'uploading') {
          this.uploading = true
        }

        let fileList = info.fileList
        let images = []

        // 1. Read from response and show file link
        images = fileList.map((file) => {
          if (file.response) {
            file.url = file.response.data[0].uri
            file.thumbUrl = file.response.data[0].uri
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
            uid: file.uid,
            name: file.name,
            status: 'done',
            url: file.url,
            thumbUrl: file.url,
          }
        })

        this.images = _.assign([], this.images, [...images])

        if (info.file.status === 'done') {
          this.uploading = false
        }
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

  .img {
    width: 100%;
    object-fit: contain;
  }
</style>
