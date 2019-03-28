<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Page Header
                <small>Optional description</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <slot></slot>
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
    export default {
        name: 'PageContent',
    };
</script>

<style scoped>
    .content-wrapper {
        min-height: 100vh;
    }
</style>
