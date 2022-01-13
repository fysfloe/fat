<template>
  <div class="autocomplete">
    <label class="label" :for="name">{{ label }} <span v-if="required" class="has-text-primary">*</span></label>
    <div :class="{'control': true, 'has-icons-left': icon !== null}">
      <input
          @focus="opened = true"
          @focusout="closeDropdown"
          @input="fetchOptions"
          class="input"
          type="text"
          :name="name"
          :id="name"
          :placeholder="label"
          :autofocus="autofocus"
          ref="input"
          :disabled="disabled"
          autocomplete="chrome-off"
      >
      <span v-if="icon" class="icon is-small is-left">
        <i :class="icon"></i>
      </span>
    </div>

    <div :class="{'autocomplete-dropdown': true, 'active': opened}">
      <ul>
        <li v-if="$refs.input && $refs.input.value.length >= 3" @click="selectOption({ name: $refs.input.value })" class="autocomplete-select-item">
          {{ $refs.input.value }}
        </li>
        <li v-else>
          <em>{{ $t('autocomplete.tooFewCharacters') }}</em>
        </li>
        <li @click="selectOption(option)" class="autocomplete-select-item" v-for="option in options" :key="option.handle">
          <p class="autocomplete-select-item-name">{{ option.name }}</p>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
  import axios from '@/config/axios';

  export default {
    name: 'autocomplete',
    props: {
      url: {
        type: String,
        required: true
      },
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
    data () {
      return {
        opened: false,
        options: []
      }
    },
    computed: {
      rules () {
        let rules = ''

        if (this.required) {
          rules += 'required'
        }

        return rules
      }
    },
    methods: {
      selectOption (option) {
        this.$emit('input', option)
      },
      closeDropdown () {
        setTimeout(() => {
          this.opened = false
        }, 10);
      },
      fetchOptions () {
        axios.get(this.url, {
          params: {
            autocomplete: this.$refs.input.value
          }
        }).then(response => {
          this.options = response.data.data
        })
      }
    }
  }
</script>

<style scoped lang="scss">
  @import '../../assets/scss/variables';

  .autocomplete {
    position: relative;

    .autocomplete-dropdown {
      display: none;
      box-shadow: 0 0 0.5em 0 lightgrey;
      padding: 0.5em;
      border-radius: 0.5em;
      position: absolute;
      width: 100%;
      background: white;
      z-index: 1;

      &.active {
        display: block;
      }

      .autocomplete-select-item {
        padding: 0.5em;
        border-radius: 0.5em;

        &:hover, &:focus, &:active {
          background: $primary;
          color: white;
          cursor: pointer;
        }

        .autocomplete-select-item-name {
          font-weight: bold;
        }
      }
    }
  }
</style>