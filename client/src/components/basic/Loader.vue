<template>
  <div class="my-loader">
    <div class="box" :style="`height: ${height}rem`"></div>
  </div>
</template>

<script>
export default {
  name: 'loader',
  props: {
    height: {
      type: Number,
      default: 1
    }
  }
}
</script>

<style scoped lang="scss">
  @import '../../assets/scss/variables';

  .my-loader {
    .box {
      animation: pulse 7s infinite;
      background-color: lighten($primary-light, 15);
      margin-bottom: 1rem;
    }
  }

  @keyframes pulse {
    0% {
      background-color: lighten($primary-light, 15);
    }

    25% {
      background-color: lighten($primary-light, 5);
    }

    50% {
      background-color: lighten($primary-light, 15);
    }

    75% {
      background-color: lighten($primary-light, 5);
    }

    100% {
      background-color: lighten($primary-light, 15);
    }
  }
</style>
