<template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <router-link class="navbar-item has-text-primary has-text-weight-bold" to="/">
        FAT
      </router-link>

      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar" @click="isActive = !isActive" v-click-outside="close">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="navbar" :class="{'navbar-menu': true, 'is-active': isActive}">
      <div class="navbar-start">
        <router-link class="navbar-item" to="/find-game">
          {{ $t('navigation.findGame') }}
        </router-link>
      </div>

      <div class="navbar-end">
        <div class="navbar-item" v-if="!isLoggedIn">
          <div class="buttons">
            <router-link to="/register" class="button is-primary">
              <strong>{{ $t('navigation.signUp') }}</strong>
            </router-link>
            <router-link to="/login" class="button is-light">
              {{ $t('navigation.login') }}
            </router-link>

          </div>
        </div>
        <div :class="{'navbar-item has-dropdown': true, 'is-active': dropdownOpen}" @click.prevent="toggleDropdown" v-else v-click-outside="closeDropdown">
          <a class="navbar-link">
            <div class="user-info">
              <div class="user-avatar">
                <img v-if="user.avatar" :src="user.avatar" :alt="`${user.firstname} ${user.lastname}`">
                <div v-else class="user-avatar-default"></div>
              </div>
              <span class="user-name">{{ user.firstname }} {{ user.lastname }}</span>
            </div>

            <div class="navbar-dropdown">
              <router-link to="/profile" class="navbar-item">
                {{ $t('navigation.profile') }}
              </router-link>
              <a class="navbar-item" @click.prevent="logout">
                {{ $t('navigation.logout') }}
              </a>
            </div>
          </a>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import ClickOutside from 'vue-click-outside'
import {mapGetters, mapState} from 'vuex'

export default {
  name: 'navigation',
  computed: {
    ...mapGetters(['isLoggedIn']),
    ...mapState({
      user: state => state.currentUser
    })
  },
  data () {
    return {
      isActive: false,
      dropdownOpen: false
    }
  },
  methods: {
    logout () {
      this.$store.dispatch('logout')
      this.$router.push('/login')
    },
    close () {
      this.isActive = false
    },
    toggleDropdown () {
      this.dropdownOpen = !this.dropdownOpen
    },
    closeDropdown () {
      this.dropdownOpen = false
    }
  },
  directives: {
    ClickOutside
  }
}
</script>

<style scoped lang="scss">
@import '../../assets/scss/variables';

.user-info {
  display: flex;
  align-items: center;

  .user-avatar {
    width: 2em;
    height: 2em;
    border-radius: 0.5em;
    overflow: hidden;
    margin-right: 0.5em;

    .user-avatar-default {
      width: 100%;
      height: 100%;
      background: $primary;
    }
  }
}
</style>
