<template>
  <div class="game-venue-details-form columns">
    <div class="column">
      <select-field
              :label="$t('game.form.venueDetails.ground')"
              name="venueDetails.ground"
              v-model="game.venue_details.ground"
              :options="groundOptions"
              required
              expanded
      />

      <input-group
              v-if="game.venue_details.ground === 'other'"
              :label="$t('game.form.venueDetails.groundAddition')"
              name="venueDetails.groundAddition"
              v-model="game.venue_details.ground_addition"
              required
      />

      <div>
        <checkbox-group :label="$t('game.form.venueDetails.venueAdditions')">
          <template slot="column-1">
            <input-group
                :label="$t('game.form.venueDetails.hasShowers')"
                name="venueDetails.hasShowers"
                v-model="additions.showers"
                type="checkbox"
                @change="adaptVenueAdditions"
            />

            <input-group
                :label="$t('game.form.venueDetails.hasEquipmentRent')"
                name="venueDetails.hasEquipmentRent"
                v-model="additions.equipment_rent"
                type="checkbox"
                @change="adaptVenueAdditions"
            />

            <input-group
                :label="$t('game.form.venueDetails.hasDrinkingWater')"
                name="venueDetails.hasDrinkingWater"
                v-model="additions.drinking_water"
                type="checkbox"
                @change="adaptVenueAdditions"
            />
          </template>

          <template slot="column-2">
            <input-group
                :label="$t('game.form.venueDetails.hasLockers')"
                name="venueDetails.hasLockers"
                v-model="additions.lockers"
                type="checkbox"
                @change="adaptVenueAdditions"
            />

            <input-group
                :label="$t('game.form.venueDetails.hasCafeteria')"
                name="venueDetails.hasCafeteria"
                v-model="additions.cafeteria"
                type="checkbox"
                @change="adaptVenueAdditions"
            />

            <input-group
                :label="$t('game.form.venueDetails.hasSauna')"
                name="venueDetails.hasSauna"
                v-model="additions.sauna"
                type="checkbox"
                @change="adaptVenueAdditions"
            />
          </template>
        </checkbox-group>

        <input-group
            :label="$t('game.form.venueDetails.description')"
            name="venueDetails.description"
            v-model="game.venue_details.description"
            type="textarea"
        />
      </div>
    </div>
  </div>
</template>

<script>
  import InputGroup from "../../basic/InputGroup";
  import SelectField from '../../basic/SelectField';
  import CheckboxGroup from '@/components/basic/CheckboxGroup';

  export default {
    name: 'game-venue-details-form',
    components: {CheckboxGroup, SelectField, InputGroup},
    props: {
      game: {
        type: Object,
        required: true
      }
    },
    data () {
      return {
        additions: {}
      }
    },
    computed: {
      groundOptions () {
        return [
          {value: 'grass', name: this.$t('game.form.venueDetails.groundOptions.grass')},
          {value: 'artificialGrass', name: this.$t('game.form.venueDetails.groundOptions.artificialGrass')},
          {value: 'concrete', name: this.$t('game.form.venueDetails.groundOptions.concrete')},
          {value: 'sand', name: this.$t('game.form.venueDetails.groundOptions.sand')},
          {value: 'indoor', name: this.$t('game.form.venueDetails.groundOptions.indoor')},
          {value: 'other', name: this.$t('game.form.venueDetails.groundOptions.other')},
        ]
      }
    },
    methods: {
      adaptVenueAdditions () {
        this.game.venue_details.additions = [];

        for (let key in this.additions) {
          if (Object.prototype.hasOwnProperty.call(this.additions, key) && true === this.additions[key]) {
            this.game.venue_details.additions.push(key)
          }
        }
      }
    }
  }
</script>

<style scoped>

</style>