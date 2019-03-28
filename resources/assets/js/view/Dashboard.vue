<template>
    <div>
        <h1> {{ message }}</h1>
    </div>
</template>

<script>
    import {Cookie} from '@/util/cookie';

    export default {
        name: 'Dashboard',
        mounted() {
            console.log(Cookie.findByName('token'));
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