<template>
  <div class="row">
    <div class="col-xs-12 col-md-8">
      <div class="box box-widget">
        <!-- /.box-box-body -->
        <div class="box-body">
          <FaqForm formAction="edit" :formData="faq"></FaqForm>
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
      ...mapGetters('faq', {
        faq: 'getItem',
      }),
    },
    beforeRouteEnter (to, from, next) {
      store.dispatch('faq/fetchItem', { id: to.params.id, params: { with: 'translations' } }).then(() => next())
    },
    beforeRouteUpdate (to, from, next) {
      store.dispatch('faq/fetchItem', to.params.id).then(() => next())
    },
  }
</script>

<style scoped>

</style>