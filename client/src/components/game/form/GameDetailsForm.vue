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
            type="datetime"
        />
      </div>
      <div class="column">
        <input-group
            :label="$t('game.form.details.endDate')"
            name="endDate"
            v-model="endDate"
            required
            type="datetime"
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
        endDate: null
      }
    },
    watch: {
      startDate () {
        if (!this.endDate || this.endDate < this.startDate) {
          this.endDate = moment(this.startDate).add(2, 'hours').format('YYYY-MM-DD HH:mm')
        }

        this.game.start_date = moment(this.startDate).format()
      },
      endDate () {
        if (!this.startDate || this.endDate < this.startDate) {
          this.startDate = moment(this.endDate).subtract(2, 'hours').format('YYYY-MM-DD HH:mm')
        }

        this.game.end_date = moment(this.endDate).format()
      },
    },
  }
</script>

<style scoped>

</style>