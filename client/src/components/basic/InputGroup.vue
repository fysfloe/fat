<template>
  <div class="input-group field">
    <template v-if="type === 'checkbox'">
      <div class="control">
        <label class="checkbox">
          <input type="checkbox" :name="name" v-model="val" :autofocus="autofocus" ref="input" :disabled="disabled">
          {{ label }}
        </label>
      </div>
    </template>
    <template v-else-if="type === 'currency'">
      <label class="label" :for="name">{{ label }} <span v-if="required">*</span></label>
      <div :class="{'control': true, 'has-icons-left': icon !== null}">
        <currency-input class="input" :name="name" :id="name" :min="min" :max="max" v-model="val" :placeholder="label" :currency="null" :autofocus="autofocus" ref="input" :disabled="disabled" />
        <span v-if="icon" class="icon is-small is-left">
          <i :class="icon"></i>
        </span>
      </div>
    </template>
    <template v-else>
      <label class="label" :for="name">{{ label }} <span v-if="required">*</span></label>
      <div :class="{'control': true, 'has-icons-left': icon !== null}">
        <input @focus="$emit('focus')" @focusout="$emit('focusout')" class="input" :type="type" :name="name" :id="name" :min="min" :max="max" v-model="val" :placeholder="label" :autofocus="autofocus" ref="input" :disabled="disabled">
        <span v-if="icon" class="icon is-small is-left">
          <i :class="icon"></i>
        </span>
      </div>
    </template>
  </div>
</template>

<script>
import moment from 'moment'

export default {
  name: 'input-group',
  props: {
    label: {
      type: String,
      required: true
    },
    type: {
      type: String,
      default: 'text'
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
    min: {
      type: Number
    },
    max: {
      type: Number
    },
    icon: {
      type: String,
      default: null
    },
    autofocus: {
      type: Boolean,
      default: false
    },
    disabled: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    val: {
      get () {
        return this.type === 'date' ? moment(String(this.value)).format('YYYY-MM-DD') : this.value
      },
      set (val) {
        this.$emit('input', val)
      }
    }
  },
  methods: {
    focusInput () {
      this.$refs.input.focus()
    }
  }
}
</script>
