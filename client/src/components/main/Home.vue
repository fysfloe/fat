<template>
  <div class="home">
    <section class="hero is-primary">
      <div class="hero-body has-text-centered">
        <h1 class="title">{{ $t('home.welcomeTitle') }}</h1>
        <div class="welcome-intro mb-5">
          {{ $t('home.welcomeIntro') }}
        </div>
        <div class="call-to-action is-flex is-justify-content-center">
          <router-link to="/find-game" class="button is-medium is-white">{{ $t('navigation.findGame') }}</router-link>
          <router-link to="/create-game" class="button is-medium is-primary">{{ $t('game.createButton') }}</router-link>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
  export default {
    name: 'home'
  }
</script>

<style scoped lang="scss">
.home {
  margin-top: -1rem;
}
</style>