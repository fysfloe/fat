<template>
  <div class="game">
    <div class="loader" v-if="isLoading">

    </div>
    <div v-else>
      <h2 class="title">{{ game.name }}</h2>
      <h3 class="subtitle">{{ game.date|moment('DD.MM.YYYY HH:mm') }}</h3>
    </div>
  </div>
</template>

<script>
  import {mapState} from "vuex";

  export default {
    name: 'Game',
    computed: {
      ...mapState({
        game: state => state.game.current,
        isLoading: state => state.game.isLoading
      })
    },
    created () {
      this.$store.dispatch('game/get', this.$route.params.id)
    }
  }
</script>

<style scoped>

</style>