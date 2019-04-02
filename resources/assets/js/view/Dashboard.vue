<template>
    <div>
        <PageHeader :title="'Dashboard'"></PageHeader>
    </div>
</template>

<script>
    import {Cookie} from '@/util/cookie';
    import PageHeader from './../components/PageHeader';
    export default {
        name: 'Dashboard',
        components: {PageHeader},
        mounted() {
            console.log('Dashboard');
        },
        data() {
            return {
                message: 'Dashboard'
            };
        }
    };
</script>

<style scoped>

</style>
