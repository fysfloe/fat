<template>
  <div class="field">
    <label class="label" :for="name">{{ label }} <span v-if="required">*</span></label>
    <div :class="{'control': true, 'has-icons-left': clearable}">
      <div :class="{'select': true, 'is-multiple': multiple}">
        <select @change="$emit('change')" :name="name" :id="name" v-model="val" :multiple="multiple">
          <option v-for="option in selectOptions" :disabled="option.value === null" :key="option.value" :value="option.value" :selected="option.value === val">{{ option.name }}</option>
        </select>
        <span v-if="clearable" class="icon is-medium is-left" @click.stop.prevent="clear">
          <i class="fas fa-times"></i>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'select-field',
  props: {
    label: {
      type: String,
      required: true
    },
    required: {
      type: Boolean,
      default: false
    },
    name: {
      type: String,
      required: true
    },
    value: {
      required: true
    },
    icon: {
      type: String,
      default: null
    },
    options: {
      type: Array,
      required: true
    },
    multiple: {
      type: Boolean,
      default: false
    },
    clearable: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    val: {
      get () {
        return this.value
      },
      set (val) {
        this.$emit('input', val)
        this.$emit('change')
      }
    },
    selectOptions () {
      const selectOptions = Array.from(this.options)
      selectOptions.unshift({ value: null, name: this.$t('common.select.choose') })

      return selectOptions
    }
  },
  methods: {
    clear () {
      this.val = null
    }
  }
}
</script>

<style scoped lang="scss">
  .control.has-icons-left .icon {
    pointer-events: inherit;
  }
</style>
