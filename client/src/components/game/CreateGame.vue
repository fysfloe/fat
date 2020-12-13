<template>
  <div class="create-game">
    <page-title>{{ $t('game.create.heading') }}</page-title>

    <form @submit.prevent="submit">
      <div class="game-form-steps">
        <game-form-step :number="1" :heading="$t('game.form.details.heading')">
          <game-details-form :game="game"/>
        </game-form-step>

        <game-form-step :number="2" :heading="$t('game.form.venue.heading')">
          <game-venue-form :game="game"/>
        </game-form-step>
      </div>

      <button type="submit" class="button is-primary">{{ $t('common.submit') }}</button>
    </form>
  </div>
</template>

<script>
  import moment from "moment";
  import PageTitle from "../basic/PageTitle";
  import GameDetailsForm from './form/GameDetailsForm';
  import GameFormStep from './form/GameFormStep';
  import GameVenueForm from './form/GameVenueForm';

  export default {
    name: 'create-game',
    components: {GameVenueForm, GameFormStep, GameDetailsForm, PageTitle},
    data () {
      return {
        game: null,
        date: null,
        time: null,
        dateTimeString: null
      }
    },
    created () {
      this.clearGame()
    },
    watch: {
      date () {
        this.dateTimeString = moment((this.date ? this.date + ' ' : '') + (this.time ?? '')).format()
      },
      time () {
        this.dateTimeString = moment((this.date ? this.date + ' ' : '') + (this.time ?? '')).format()
      },
      dateTimeString () {
        this.game.date = this.dateTimeString
      }
    },
    methods: {
      submit () {
        this.$store.dispatch('game/create', this.game)
      },
      clearGame () {
        this.date = null
        this.time = null
        this.game = {
          name: null,
          date: null,
          time: null,
          venue: {},
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