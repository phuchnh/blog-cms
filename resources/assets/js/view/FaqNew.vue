<template>
  <div class="row">
    <div class="col-xs-12 col-md-8">
      <div class="box box-widget">
        <!-- /.box-box-body -->
        <div class="box-body">
          <FaqForm formAction="new"></FaqForm>
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
  import { mapMutations } from 'vuex'
  import FaqForm from '@/components/FaqForm'

  export default {
    name: 'FaqNew',
    components: {
      FaqForm,
    },
    mounted () {
      this.resetForm()
    },
    methods: {
      ...mapMutations('faq', {
        resetForm: 'RESET_ITEM',
      }),
    },
  }
</script>

<style scoped>

</style>