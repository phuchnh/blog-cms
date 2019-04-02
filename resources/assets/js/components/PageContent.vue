<template>
    <div class="content-wrapper">
        <slot></slot>
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
