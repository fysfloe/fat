<template>
  <h2 class="title is-flex is-justify-content-space-between">
    <span><slot></slot></span>
    <span><slot name="action"></slot></span>
  </h2>
</template>

<script>
  export default {
    name: 'page-title'
  }
</script>

<style scoped>

</style>