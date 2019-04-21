<template>
  <div class="row" :v-loading="loading">
    <div class="col-xs-12 col-md-8" v-if="formValue">
      <div class="box box-widget">
        <!-- /.box-box-body -->
        <div class="box-body">
          <FaqForm formAction="edit" :formValue="formValue"></FaqForm>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-4">
      <div class="box box-widget">
        <!-- /.box-box-body -->
        <div class="box-body">
          <!--<FaqForm></FaqForm>-->
        </div>
      </div>
      <div class="box box-widget">
        <!-- /.box-box-body -->
        <div class="box-body">
          <!--<FaqForm></FaqForm>-->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import FaqForm from '@/components/FaqForm'
  import store from '@/store'

  export default {
    name: 'FaqDetail',
    components: {
      FaqForm,
    },
    computed: {
      ...mapGetters('faq', ['onFetchItem', 'getItem']),
      loading () {
        return this.onFetchItem
      },
      formValue () {
        return this.getItem
      },
    },
    beforeRouteEnter (to, from, next) {
      store.dispatch('faq/fetchItem', to.params.id)
           .then(() => next())
    },
  }
</script>

<style scoped>

</style>