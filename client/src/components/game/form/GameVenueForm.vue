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

        <select-field
                :label="$t('game.form.venue.country')"
                name="venue.country"
                v-model="game.location.country"
                :options="countries"
                required
                :disabled="!!game.venue"
        />
      </div>
    </div>
  </div>
</template>

<script>
  import InputGroup from "../../basic/InputGroup";
  import Separator from '../../basic/Separator';
  import {mapState} from 'vuex';
  import VenueSelect from './VenueSelect';
  import SelectField from '../../basic/SelectField';

  export default {
    name: 'game-venue-form',
    components: {SelectField, VenueSelect, Separator, InputGroup},
    props: {
      game: {
        type: Object,
        required: true
      }
    },
    computed: {
      ...mapState({
        venues: state => state.venue.items,
        countries: state => {
          const countryArray = []

          for (const countryCode in state.countries) {
            if (Object.prototype.hasOwnProperty.call(state.countries, countryCode)) {
              countryArray.push({
                value: countryCode,
                name: state.countries[countryCode]
              })
            }
          }

          return countryArray
        }
      })
    },
    mounted () {
      this.$store.dispatch('venue/fetch')
      this.$store.dispatch('getCountries')
    },
  }
</script>

<style scoped>

</style>