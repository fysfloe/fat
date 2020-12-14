<template>
  <div class="game-venue-form columns">
    <div class="column">
      <separator>{{ $t('game.form.venue.chooseExistingVenue') }}</separator>

      <venue-select
        :venues="venues"
        :game="game"
      />

      <separator>{{ $t('game.form.venue.orEnterLocation') }}</separator>

      <div>
        <input-group
                :label="$t('game.form.venue.street')"
                name="venue.street"
                v-model="game.location.street"
                required
                :disabled="!!game.venue"
        />

        <input-group
                :label="$t('game.form.venue.zipCode')"
                name="venue.zip_code"
                v-model="game.location.zip_code"
                required
                :disabled="!!game.venue"
        />

        <input-group
                :label="$t('game.form.venue.city')"
                name="venue.city"
                v-model="game.location.city"
                required
                :disabled="!!game.venue"
        />

        <input-group
                :label="$t('game.form.venue.country')"
                name="venue.country"
                v-model="game.location.country"
                required
                :disabled="!!game.venue"
        />
      </div>
    </div>
  </div>
</template>

<script>
  import InputGroup from "../../basic/InputGroup";
  import moment from "moment";
  import Separator from '../../basic/Separator';
  import {mapState} from 'vuex';
  import VenueSelect from './VenueSelect';

  export default {
    name: 'game-venue-form',
    components: {VenueSelect, Separator, InputGroup},
    props: {
      game: {
        type: Object,
        required: true
      }
    },
    data () {
      return {
        time: null,
        date: null
      }
    },
    computed: {
      ...mapState({
        venues: state => state.venue.items
      })
    },
    mounted () {
      this.$store.dispatch('venue/fetch')
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
  }
</script>

<style scoped>

</style>