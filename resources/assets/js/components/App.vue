<template>
    <div>
        <h1 class="test">{{message}}</h1>
    </div>
</template>

<script>
    export default {
        name: 'App',
        data() {
            return {
                message: 'Hello Admin'
            };
        }
    };
</script>

<style scoped lang="scss">
    .test {
        color: red;
    }
</style>