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
    >
      <game-venue-form :game="game"/>
    </game-form-step>

    <game-form-step
            :number="3"
            ref="step-3"
            :heading="$t('game.form.venueDetails.heading')"
            @nextStep="next"
            @previousStep="previous"
            @setCurrentStep="setCurrentStep(3)"
            :is-current-step="currentStep === 3"
    >
      <game-venue-details-form :game="game" />
    </game-form-step>

    <game-form-step
        :number="4"
        ref="step-4"
        :heading="$t('game.form.players.heading')"
        @nextStep="next"
        @previousStep="previous"
        @setCurrentStep="setCurrentStep(4)"
        :is-current-step="currentStep === 4"
        is-last
    >
      <game-players-form :game="game" />
    </game-form-step>
  </div>
</template>

<script>
  import GameFormStep from './GameFormStep';
  import GameDetailsForm from './GameDetailsForm';
  import GameVenueForm from './GameVenueForm';
  import GameVenueDetailsForm from './GameVenueDetailsForm';
  import GamePlayersForm from '@/components/game/form/GamePlayersForm';

  export default {
    name: 'game-form-steps',
    components: {GamePlayersForm, GameVenueDetailsForm, GameVenueForm, GameDetailsForm, GameFormStep},
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