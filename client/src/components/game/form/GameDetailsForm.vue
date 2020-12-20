<template>
  <div class="game-details-form">
    <input-group
            :label="$t('game.form.details.name')"
            name="name"
            v-model="game.name"
            required
    />

    <div class="columns">
      <div class="column">
        <input-group
            :label="$t('game.form.details.startDate')"
            name="startDate"
            v-model="startDate"
            required
            type="date"
        />

        <input-group
            :label="$t('game.form.details.startTime')"
            name="startTime"
            v-model="startTime"
            required
            type="time"
        />
      </div>
      <div class="column">
        <input-group
            :label="$t('game.form.details.endDate')"
            name="endDate"
            v-model="endDate"
            required
            type="date"
        />

        <input-group
            :label="$t('game.form.details.endTime')"
            name="endTime"
            v-model="endTime"
            required
            type="time"
        />
      </div>
    </div>

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
        startDate: null,
        startTime: null,
        endDate: null,
        endTime: null,
        startDateTimeString: null,
        endDateTimeString: null
      }
    },
    watch: {
      startDate () {
        this.startDateTimeString = moment((this.startDate ? this.startDate + ' ' : '') + (this.startTime ?? '')).format()
      },
      startTime () {
        this.startDateTimeString = moment((this.startDate ? this.startDate + ' ' : '') + (this.startTime ?? '')).format()
      },
      startDateTimeString () {
        this.game.start_date = this.startDateTimeString
      },
      endDate () {
        this.endDateTimeString = moment((this.endDate ? this.endDate + ' ' : '') + (this.endTime ?? '')).format()
      },
      endTime () {
        this.endDateTimeString = moment((this.endDate ? this.endDate + ' ' : '') + (this.endTime ?? '')).format()
      },
      endDateTimeString () {
        this.game.end_date = this.endDateTimeString
      }
    },
  }
</script>

<style scoped>

</style>