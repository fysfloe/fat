<template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <router-link class="navbar-item" to="/">
        FAT
      </router-link>

      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample" @click="isActive = !isActive">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="navbarBasicExample" :class="{'navbar-menu': true, 'is-active': isActive}">
      <div class="navbar-start">
        <router-link class="navbar-item" to="/">
          {{ $t('navigation.home') }}
        </router-link>

        <router-link class="navbar-item" to="/find-game">
          {{ $t('navigation.findGame') }}
        </router-link>
      </div>

      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <router-link to="/register" class="button is-primary">
              <strong>{{ $t('navigation.signUp') }}</strong>
            </router-link>
            <router-link v-if="!isLoggedIn" to="/login" class="button is-light">
              {{ $t('navigation.login') }}
            </router-link>
            <a v-else href="#" class="button is-light" @click.prevent="logout">
              {{ $t('navigation.logout') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import ClickOutside from 'vue-click-outside'
import { mapGetters } from 'vuex'

export default {
  name: 'navigation',
  computed: {
    ...mapGetters(['isLoggedIn'])
  },
  data () {
    return {
      isActive: false
    }
  },
  methods: {
    logout () {
      this.$store.dispatch('logout')
      this.$router.push('/login')
    }
  },
  directives: {
    ClickOutside
  }
}
</script>

<style scoped lang="scss">
@import '../../assets/scss/variables';
</style>
