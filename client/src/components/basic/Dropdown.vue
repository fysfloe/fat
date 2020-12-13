<template>
  <div :class="{'dropdown is-right': true, 'is-active': showDropdown}" v-click-outside="hideDropdown">
    <div class="dropdown-trigger">
      <slot name="dropdownTrigger">
        <button class="button is-primary is-small is-outlined is-rounded" aria-haspopup="true" :aria-controls="id" @click="showDropdown = !showDropdown">
          <slot name="buttonContent">
            <span class="icon is-small">
              <i class="fas fa-ellipsis-v" aria-hidden="true"></i>
            </span>
          </slot>
        </button>
      </slot>
    </div>
    <div class="dropdown-menu" :id="id" role="menu" @click="hideDropdown">
      <div class="dropdown-content">
        <slot name="dropdownContent"></slot>
      </div>
    </div>
  </div>
</template>

<script>
import ClickOutside from 'vue-click-outside'

export default {
  name: 'dropdown',
  props: {
    id: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      showDropdown: false
    }
  },
  methods: {
    hideDropdown () {
      this.showDropdown = false
    }
  },
  directives: {
    ClickOutside
  }
}
</script>

<style scoped lang="scss">
.dropdown {
  &.is-active {
    .dropdown-trigger {
      .button {
        &:active, &:focus, &:hover {
          background: white;
          color: inherit;
          border-radius: 1rem 1rem 0 0;
          border-color: white;
        }
      }
    }
  }

  .dropdown-menu {
    padding-top: 0;
    margin-top: -1px;

    .dropdown-content {
      border-top-right-radius: 0;
    }
  }
}
</style>
