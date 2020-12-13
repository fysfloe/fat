<template>
  <div class="game-form-steps">
    <game-form-step
            :number="1"
            ref="step-1"
            :heading="$t('game.form.details.heading')"
            @nextStep="next"
            @previousStep="previous"
            @setCurrentStep="setCurrentStep(1)"
            :is-current-step="currentStep === 1"
            is-first
    >
      <game-details-form :game="game"/>
    </game-form-step>

    <game-form-step
            :number="2"
            ref="step-2"
            :heading="$t('game.form.venue.heading')"
            @nextStep="next"
            @previousStep="previous"
            @setCurrentStep="setCurrentStep(2)"
            :is-current-step="currentStep === 2"
            is-last
    >
      <game-venue-form :game="game"/>
    </game-form-step>
  </div>
</template>

<script>
  import GameFormStep from './GameFormStep';
  import GameDetailsForm from './GameDetailsForm';
  import GameVenueForm from './GameVenueForm';

  export default {
    name: 'game-form-steps',
    components: {GameVenueForm, GameDetailsForm, GameFormStep},
    props: {
      game: {
        type: Object,
        required: true
      }
    },
    data () {
      return {
        currentStep: 1,
        numSteps: 4
      }
    },
    watch: {
      currentStep () {
        this.$scrollTo(this.$refs[`step-${this.currentStep}`].$el)
      }
    },
    methods: {
      next () {
        this.currentStep++
      },
      previous () {
        this.currentStep--
      },
      setCurrentStep (number) {
        this.currentStep = number
      }
    }
  }
</script>

<style scoped lang="scss">
  @import '../../../assets/scss/variables';

  .game-form-steps {

  }
</style>