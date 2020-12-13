<template>
  <div class="separator">
    <span class="text">
      <slot></slot>
    </span>
  </div>
</template>

<script>
  export default {
    name: 'separator'
  }
</script>

<style scoped lang="scss">
  @import '../../assets/scss/variables';

  .separator {
    margin: 1rem 0;
    width: 100%;
    text-align: center;
    position: relative;

    .text {
      background: white;
      display: inline-block;
      padding: 0 0.25em;
      text-transform: uppercase;
      font-size: 0.75em;
    }

    &:before {
      height: 0.2rem;
      width: 100%;
      content: '';
      display: block;
      background: $primary-light;
      position: absolute;
      top: 0.75em;
      z-index: -1;
    }
  }
</style>