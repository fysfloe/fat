<template>
  <div class="create-game">
    <page-title>{{ $t('game.create.heading') }}</page-title>

    <form @submit.prevent="submit">
      <game-form-steps :game="game"></game-form-steps>
    </form>
  </div>
</template>

<script>
  import moment from 'moment';
  import PageTitle from '../basic/PageTitle';
  import GameFormSteps from './form/GameFormSteps';

  export default {
    name: 'create-game',
    components: {GameFormSteps, PageTitle},
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
          venue: null,
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