<template>
  <div class="input-group field">
    <validation-provider :rules="rules" v-slot="{ errors }">
      <template v-if="type === 'checkbox'">
        <div class="control">
          <label class="checkbox">
            <input type="checkbox" @change="$emit('change')" :name="name" v-model="val" :autofocus="autofocus" ref="input" :disabled="disabled">
            {{ label }}
          </label>
        </div>
      </template>
      <template v-else-if="type === 'textarea'">
        <label class="label" :for="name">{{ label }} <span v-if="required" class="has-text-primary">*</span></label>
        <div :class="{'control': true, 'has-icons-left': icon !== null}">
        <textarea
            @focus="$emit('focus')"
            @focusout="$emit('focusout')"
            class="textarea"
            :name="name"
            :id="name"
            v-model="val"
            :placeholder="label"
            :autofocus="autofocus"
            ref="input"
            :disabled="disabled"
            :autocomplete="autocomplete"
        />
          <span v-if="icon" class="icon is-small is-left">
          <i :class="icon"></i>
        </span>
        </div>
      </template>
      <template v-else-if="type === 'datetime'">
        <label class="label" :for="name">{{ label }} <span v-if="required" class="has-text-primary">*</span></label>
        <div :class="{'control': true, 'has-icons-left': icon !== null}">
          <input
              @focus="$emit('focus')"
              @focusout="$emit('focusout')"
              class="input"
              type="text"
              :name="name"
              :id="name"
              :min="min"
              :max="max"
              v-model="val"
              :placeholder="label"
              :autofocus="autofocus"
              ref="input"
              :disabled="disabled"
              :autocomplete="autocomplete"
          >
          <span v-if="icon" class="icon is-small is-left">
          <i :class="icon"></i>
          </span>
        </div>
      </template>
      <template v-else-if="type === 'currency'">
        <label class="label" :for="name">{{ label }} <span v-if="required" class="has-text-primary">*</span></label>
        <div :class="{'control': true, 'has-icons-left': icon !== null}">
          <currency-input class="input" :name="name" :id="name" :min="min" :max="max" v-model="val" :placeholder="label" :currency="null" :autofocus="autofocus" ref="input" :disabled="disabled" />
          <span v-if="icon" class="icon is-small is-left">
          <i :class="icon"></i>
        </span>
        </div>
      </template>
      <template v-else>
        <label class="label" :for="name">{{ label }} <span v-if="required" class="has-text-primary">*</span></label>
        <div :class="{'control': true, 'has-icons-left': icon !== null}">
          <input
              @focus="$emit('focus')"
              @focusout="$emit('focusout')"
              class="input"
              :type="type"
              :name="name"
              :id="name"
              :min="min"
              :max="max"
              v-model="val"
              :placeholder="label"
              :autofocus="autofocus"
              ref="input"
              :disabled="disabled"
              :autocomplete="autocomplete"
          >
          <span v-if="icon" class="icon is-small is-left">
          <i :class="icon"></i>
        </span>
        </div>
      </template>
      <div class="has-text-danger mt-2">{{ errors[0] }}</div>
    </validation-provider>
  </div>
</template>

<script>
import moment from 'moment'
import { ValidationProvider, extend } from 'vee-validate';
import { required } from 'vee-validate/dist/rules';
import flatpickr from 'flatpickr';

extend('required', {
  ...required,
  message: 'This field is required'
});

export default {
  name: 'input-group',
  components: {ValidationProvider},
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
    },
    autocomplete: {
      type: String,
      default: null
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
    },
    rules () {
      let rules = ''

      if (this.required) {
        rules += 'required'
      }

      return rules
    }
  },
  methods: {
    focusInput () {
      this.$refs.input.focus()
    }
  },
  mounted () {
    if (this.type === 'datetime') {
      flatpickr(this.$refs.input, {
        enableTime: true,
        dateFormat: 'Y-m-d H:i',
      });
    }
  }
}
</script>
