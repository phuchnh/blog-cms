<template>
    <div>
        <!-- Content Header (Page header) -->
        <PageHeader :title="'User Detail'"></PageHeader>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box">
                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="form-group" :class="{ 'has-error': errors.first('name') }">
                            <label for="name" class="col-sm-2 control-label">Username <span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input v-validate="'required'" class="form-control" id="name" name="name" v-model="user.name"  />
                                <div class="help-block" v-if="errors.first('name')">
                                    <span>{{ errors.first('name') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" :class="{ 'has-error': errors.first('email') }">
                            <label for="email" class="col-sm-2 control-label">Email <span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input v-validate="'required'" class="form-control" type="email" id="email" name="email" v-model="user.email"  />
                                <div class="help-block" v-if="errors.first('email')">
                                    <span>{{ errors.first('email') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" :class="{ 'has-error': errors.first('type') }">
                            <label for="type" class="col-sm-2 control-label">Level <span class="required">*</span></label>
                            <div class="col-sm-3">
                                <select v-validate="'required'" class="form-control" id="type" name="type" v-model="user.type">
                                    <option v-for="type in userType" :value="type">{{type}}</option>
                                </select>
                                <div class="help-block" v-if="errors.first('type')">
                                    <span>{{ errors.first('type') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-4">
                                <button @click="cancel" class="btn btn-default margin-r-5" type="button">Cancel</button>
                                <button @click="submit" type="button" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
  import PageHeader from '../components/PageHeader';
  import {mapGetters} from 'vuex';
  export default {
    name: 'UserDetail',
    components: {PageHeader},
    computed: {
      ...mapGetters({
        saved: 'user/saved',
        user: 'user/user'
      })
    },
    beforeRouteLeave(from, to, next) {
      if (!this.saved) {
        this.$confirm({
          title: 'Are you sure you want to leave without saving?',
          okText: 'Yes',
          okType: 'danger',
          cancelText: 'No',
          onOk: () => {
            this.$store.dispatch('user/resetState');
            next();
          },
        });
      } else {
        this.$store.dispatch('user/resetState');
        next();
      }
    },
    mounted() {
        this.$store.dispatch('user/getUser', this.$route.params.id);
        this.$store.dispatch('user/savedUser', true);
    },
    data() {
      return {
        userType: ['admin', 'editor']
      }
    },
    methods: {
      submit() {
        this.$validator.validateAll().then((result) => {
          if (result) {
            this.$store.dispatch('user/updateUser', this.user).then(() => {
              this.$store.dispatch('user/savedUser', true);
              this.$message.success('Update successfully');
              this.$router.push({name: 'userList'});
            })
                .catch((error) => {
                  console.log(error);
                  this.$message.error('Error');
                });
          } else {
            this.$message.error('Invalid Form !')
          }
        })
      },
      cancel() {
        this.$router.push({name: 'userList'});
      }
    }
  };
</script>

<style scoped>

</style>
