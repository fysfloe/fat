<template>
  <div class="create-game">
    <page-title>{{ $t('game.create.heading') }}</page-title>

    <form @submit.prevent="submit">
      <game-form-steps :game="game"></game-form-steps>
    </form>
  </div>
</template>

<script>
  import PageTitle from '../basic/PageTitle';
  import GameFormSteps from './form/GameFormSteps';

  export default {
    name: 'create-game',
    components: {GameFormSteps, PageTitle},
    data () {
      return {
        game: null
      }
    },
    created () {
      this.clearGame()
    },
    methods: {
      async submit () {
        let game = await this.$store.dispatch('game/create', this.game)

        await this.$router.push(`/game/${game.id}`)
      },
      clearGame () {
        this.date = null
        this.time = null
        this.game = {
          name: null,
          start_date: null,
          end_date: null,
          time: null,
          venue: null,
          venue_details: {
            ground: 'grass',
            ground_addition: null,
            description: null
          },
          location: {},
          players_per_side: null,
          private: false
        }
      }
    }
  }
</script>

<style scoped>

</style>