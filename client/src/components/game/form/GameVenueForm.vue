<template>
  <div class="game-venue-form columns">
    <div class="column">
      <separator>{{ $t('game.form.venue.chooseExistingVenue') }}</separator>

      <div>
        <input-group
                :label="$t('game.form.venue.name')"
                name="venue.name"
                v-model="game.venue.name"
                required
        />
      </div>

      <separator>{{ $t('game.form.venue.orEnterLocation') }}</separator>

      <div>
        <input-group
                :label="$t('game.form.venue.street')"
                name="venue.street"
                v-model="game.location.street"
                required
        />

        <input-group
                :label="$t('game.form.venue.zipCode')"
                name="venue.zip_code"
                v-model="game.location.zip_code"
                required
        />

        <input-group
                :label="$t('game.form.venue.city')"
                name="venue.city"
                v-model="game.location.city"
                required
        />

        <input-group
                :label="$t('game.form.venue.country')"
                name="venue.country"
                v-model="game.location.country"
                required
        />
      </div>
    </div>
  </div>
</template>

<script>
  import InputGroup from "../../basic/InputGroup";
  import moment from "moment";
  import Separator from '../../basic/Separator';

  export default {
    name: 'game-venue-form',
    components: {Separator, InputGroup},
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