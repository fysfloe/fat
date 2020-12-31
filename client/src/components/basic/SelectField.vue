<template>
  <div class="select-field">
    <div class="field" v-if="!expanded">
      <label class="label" :for="name">{{ label }} <span v-if="required" class="has-text-primary">*</span></label>
      <div :class="{'control': true, 'has-icons-left': clearable}">
        <div :class="{'select': true, 'is-multiple': multiple}">
          <select @change="$emit('change')" :name="name" :id="name" v-model="val" :multiple="multiple" :disabled="disabled">
            <option v-for="option in selectOptions" :disabled="option.value === null" :key="option.value" :value="option.value" :selected="option.value === val">{{ option.name }}</option>
          </select>
          <span v-if="clearable" class="icon is-medium is-left" @click.stop.prevent="clear">
          <i class="fas fa-times"></i>
        </span>
        </div>
      </div>
    </div>

    <div class="expanded-field" v-else>
      <label class="label" :for="name">{{ label }} <span v-if="required" class="has-text-primary">*</span></label>

      <div class="is-flex is-flex-wrap-wrap">
        <div :class="{'expanded-option': true, 'selected': option.value === val}" v-for="option in options" :key="option.value" @click="val = option.value">
          {{ option.name }}
        </div>
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
    },
    disabled: {
      type: Boolean,
      default: false
    },
    expanded: {
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
  @import '../../assets/scss/variables';

  .control.has-icons-left .icon {
    pointer-events: inherit;
  }

  .select-field {
    .expanded-field {
      margin-bottom: 1.5em;

      .expanded-option {
        padding: 0.5em 1em;
        border: 0.15em solid $lightgrey;
        margin-right: 0.5em;
        border-radius: 0.5em;
        box-sizing: border-box;

        &:hover {
          cursor: pointer;
        }

        &.selected {
          border-color: $primary;
          box-shadow: 0 0 0.1em 0 $primary;
        }
      }
    }
  }
</style>
