<template>
  <div>
      <transition name="fade" mode="out-in">
          <router-view></router-view>
      </transition>
  </div>
</template>

<script>
    export default {
        name: 'Admin',
        data() {
            return {
                messsage: 'Admin'
            };
        },
        mounted() {
            console.log('mounted');
        }
    };
</script>

<style scoped lang="scss">
    .fade-enter-active, .fade-leave-active {
        transition: all 0.5s ease;
    }

    .fade-enter, .fade-leave-active {
        opacity: 0
    }
</style>