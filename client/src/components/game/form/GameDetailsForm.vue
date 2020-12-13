<template>
  <div class="game-details-form">
    <input-group
            :label="$t('game.form.details.name')"
            name="name"
            v-model="game.name"
            required
    />

    <input-group
            :label="$t('game.form.details.date')"
            name="date"
            v-model="date"
            required
            type="date"
    />

    <input-group
            :label="$t('game.form.details.time')"
            name="time"
            v-model="time"
            required
            type="time"
    />

    <input-group
            :label="$t('game.form.details.private')"
            name="private"
            v-model="game.private"
            type="checkbox"
    />
  </div>
</template>

<script>
  import InputGroup from "../../basic/InputGroup";
  import moment from "moment";

  export default {
    name: 'game-details-form',
    components: {InputGroup},
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