<template>
  <div class="create-game">
    <page-title>{{ $t('game.create.heading') }}</page-title>

    <ValidationObserver v-slot="{ handleSubmit }">
      <form @submit.prevent="handleSubmit(submit)">
        <game-form-steps :game="game"></game-form-steps>
      </form>
    </ValidationObserver>
  </div>
</template>

<script>
  import PageTitle from '../basic/PageTitle';
  import GameFormSteps from './form/GameFormSteps';
  import { ValidationObserver } from 'vee-validate';

  export default {
    name: 'create-game',
    components: {GameFormSteps, PageTitle, ValidationObserver},
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
          num_players: null,
          players_can_invite: false,
          players: [],
          invitees: [],
          private: false
        }
      }
    }
  }
</script>

<style scoped>

</style>