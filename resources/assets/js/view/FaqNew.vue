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
      <div class="row">
        <div class="col-xs-12">
          <TaxonomyBox :title="'Group'" :taxonomy="'group'" :hierarchy="true"></TaxonomyBox>
        </div>
        <div class="col-xs-12">
<!--          <TaxonomyBox :title="'Tag'" :taxonomy="'tag'" :hierarchy="false"></TaxonomyBox>-->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapMutations } from 'vuex'
  import FaqForm from '@/components/FaqForm'
  import TaxonomyBox from '@/components/TaxonomyBox.vue'

  export default {
    name: 'FaqNew',
    components: {
      FaqForm,
      TaxonomyBox,
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