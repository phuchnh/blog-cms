<template>
  <div>
    <div class="box box-widget no-border">
      <div class="box-body" v-if="setHierarchy" key="hierarchy">
        <form role="form">
          <fieldset>
            <div class="form-group">
              <label for="category">{{ boxTitle }}</label>
              <select name="name" id="category" class="form-control" v-model="selectedId">
                <option value="0" selected> -- Select One --</option>
                <option v-for="taxonomy of taxonomies" :value="taxonomy.id">{{ taxonomy.title }}
                </option>
              </select>
            </div>
          </fieldset>
        </form>
        <hr>
        <form role="form" @submit.prevent="onSubmit">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" v-model="newTaxonomy.title">
          </div>
          <div class="form-group">
            <label for="parent">Parent</label>
            <select name="name" id="parent" class="form-control" v-model="newTaxonomy.parent_id">
              <option value="0" selected> -- Select One --</option>
              <option v-for="taxonomy of taxonomies" :value="taxonomy.id">{{ taxonomy.title }}</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
      <!--      <div class="box-body" v-if="!hierarchy" key="hierarchy">-->
      <!--        <div class="form-group">-->
      <!--          <label for="parent">{{ title }}</label>-->
      <!--          <el-select-->
      <!--              v-model="tags"-->
      <!--              multiple-->
      <!--              filterable-->
      <!--              allow-create-->
      <!--              default-first-option-->
      <!--              size="large"-->
      <!--              placeholder="Choose tags for your article"-->
      <!--              style="width: 100%"-->
      <!--              @change="tagsChange"-->
      <!--              no-data-text="No data">-->
      <!--            <el-option-->
      <!--                v-for="item in options"-->
      <!--                :key="item.value"-->
      <!--                :label="item.label"-->
      <!--                :value="item.value">-->
      <!--            </el-option>-->
      <!--          </el-select>-->
      <!--        </div>-->
      <!--      </div>-->
    </div>
  </div>
</template>

<script>

  import { mapActions, mapGetters, mapMutations } from 'vuex'
  import store from '@/store'

  export default {
    name: 'TaxonomyBox',
    props: {
      value: {
        type: Number,
        default: 0,
      },
      boxTitle: {
        type: String,
        default: 'category',
      },
      boxType: {
        type: String,
        default: 'category',
      },
      setHierarchy: {
        type: Boolean,
        default: true,
      },
    },
    data () {
      return {
        selectedId: this.value,
        newTaxonomy: {
          title: '',
          parent_id: null,
          locale: 'vi',
          type: this.boxType,
        },
      }
    },
    beforeMount () {
      store.dispatch('taxonomy/fetchList', { type: this.boxType })
    },

    computed: {
      ...mapGetters('taxonomy', ['getAll', 'getListByType']),
      taxonomies () {
        return this.getListByType(this.boxType)
      },
    },

    watch: {
      selectedId (newValue, oldValue) {
        if (newValue !== oldValue) {
          this.$emit('input', newValue)
        }
      },
    },

    methods: {
      ...mapActions('taxonomy', ['update', 'create']),
      ...mapMutations('taxonomy', ['updateStateByName']),

      addNewTaxonomy (data) {
        this.create(data).then(data => this.selectedId = data.id)
      },

      onSubmit () {
        this.addNewTaxonomy(this.newTaxonomy)
      },

      tagsChange (value) {
        this.setData({
          title: value[(value.length - 1)],
          parent_id: this.parent_id,
          type: this.type,
        })
      },
    },
  }
</script>

<style scoped>
</style>