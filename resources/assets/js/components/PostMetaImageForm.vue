<template>
  <div id="PostMetaImageForm" class="box">
    <div class="box-header with-border">
      <h3 class="box-title text-capitalize">{{ title }}</h3>

      <div @click="uploadHandleImage" class="btn btn-sm btn-warning pull-right">
        <i class="fa fa-upload"></i> Upload
      </div>

      <p class="btn btn-default btn-sm btn-file pull-right">
        <i class="fa fa-search"></i> Find image

        <input type="file" class="form-control"
               :id="title"
               name="image"
               accept="image/*"
               @change="onFileChangeImage($event)"/>

      </p>
    </div>
    <!-- /.box-header -->

    <!-- form start -->
    <div class="box-body text-center" v-show="imgUrl || image">
      <img class="img img-thumbnail form-group" width="200"
           :src="imgUrl ? imgUrl : image">
    </div>
  </div>
</template>

<script>
  import { Cookie } from '@/util'
  import axios from 'axios'

  export default {
    name: 'PostMetaImageForm',
    props: {
      value: {
        type: String | Object | Array,
      },
      title: {
        type: String,
      },
    },
    data () {
      return {
        image: null,
        imgUrl: this.value ? this.value : '',
        fileInput: null,
        message: '',
        showMessage: false,
      }
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
      /**
       * show preview image
       */
      onFileChangeImage (event) {
        const file = event.target.files[0]
        const reader = new FileReader()

        reader.readAsDataURL(file)
        reader.onloadend = () => {
          this.image = reader.result
        }

        this.fileInput = file
      },
      /**
       * upload image through Axios
       */
      uploadHandleImage () {
        let formData = new FormData()
        formData.append('files[0]', this.fileInput)

        if (this.fileInput) {
          axios.post('/api/assets', formData, {
            headers: {
              'Content-Type': 'multipart/form-data',
              'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              'Authorization': 'Bearer ' + Cookie.findByName('token'),
            },
          }).then(res => {
            if (res.status === 200) {
              this.imgUrl = res.data.data[0].uri

              this.resetData()

              this.$message({
                message: 'Upload image successful!',
                type: 'success'
              });
            }
          }).catch(err => {
            this.$message({
              message: 'Upload image unsuccessful!',
              type: 'error'
            });
          })
        }
      },
      resetData () {
        this.fileInput = null
      }
    },
  }
</script>

<style scoped>
  .btn-file{
    margin-right: 15px;
  }
</style>
