<template>
    <section class="content-header">
        <h1>
           {{title}}
        </h1>
        <ol class="breadcrumb">
            <li><router-link :to="{name: 'admin'}"><i class="fa fa-dashboard"></i> Home</router-link></li>
            <li class="active">{{title}}</li>
        </ol>
    </section>
</template>

<script>
  export default {
    name: 'PageHeader',
    props: {
      title: String
    }
  };
</script>

<style scoped>

</style>
