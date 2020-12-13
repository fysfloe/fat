<template>
  <div class="find-game">
    <h2 class="title is-flex is-justify-content-space-between">
      <span>{{ $t('findGame.heading') }}</span>
      <router-link to="/game/create" class="button is-primary">{{ $t('game.createButton') }}</router-link>
    </h2>

    <ul class="game-list" v-if="games.length > 0">
      <li v-for="game in games" :key="game.id">
        <router-link :to="`/game/${game.id}`">
          {{ game.name }}
        </router-link>
      </li>
    </ul>

    <div class="no-games" v-else>
      {{ $t('findGame.noGamesFound') }}
    </div>
  </div>
</template>

<script>
  import {mapState} from "vuex";

  export default {
    name: 'find-game',
    computed: {
      ...mapState({
        games: state => state.game.items
      })
    },
    created () {
      this.$store.dispatch('game/fetch')
    }
  }
</script>

<style scoped>

</style>