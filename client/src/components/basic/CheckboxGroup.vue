<template>
  <div class="checkbox-group">
    <h3 class="label">{{ label }}</h3>

    <div class="checkbox-group-checkboxes columns">
      <div class="column">
        <slot name="column-1"></slot>
      </div>
      <div class="column">
        <slot name="column-2"></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'checkbox-group',
  props: {
    label: {
      type: String,
      required: true
    }
  }
}
</script>

<style scoped lang="scss">
.checkbox-group {
  margin-bottom: 1.5em;
}
</style>