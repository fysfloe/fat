<template>
  <div class="find-game">
    <h2 class="title is-flex is-justify-content-space-between">
      <span>{{ $t('game.list.heading') }}</span>
      <router-link to="/game/create" class="button is-primary">{{ $t('game.createButton') }}</router-link>
    </h2>

    <ul class="game-list is-flex is-flex-wrap-wrap" v-if="games.length > 0">
      <li v-for="game in games" :key="game.id">
        <game-list-item :game="game" />
      </li>
    </ul>

    <div class="no-games" v-else>
      {{ $t('findGame.noGamesFound') }}
    </div>
  </div>
</template>

<script>
  import {mapState} from "vuex";
  import GameListItem from '@/components/game/GameListItem';

  export default {
    name: 'find-game',
    components: {GameListItem},
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

<style scoped lang="scss">
@import '../../assets/scss/variables';

.game-list {

}
</style>