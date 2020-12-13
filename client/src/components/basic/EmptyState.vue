<template>
  <div class="empty-state has-text-centered">
    <img src="/img/empty_state.png">
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: 'empty-state'
}
</script>

<style scoped>
img {
  width: 75%;
  margin: 0 auto;
  max-width: 250px;
  display: block;
}
</style>
