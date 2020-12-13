<template>
  <div :class="{'game-form-step is-flex is-align-items-flex-start': true, 'is-current-step': isCurrentStep, 'is-in-viewport': isInViewport}">
    <div class="game-form-step-number" @click="$emit('setCurrentStep')">
      {{ number }}
    </div>
    <div class="game-form-step-content is-flex-grow-1">
      <h3 class="game-form-step-heading" v-if="heading" @click="$emit('setCurrentStep')">{{ heading }}</h3>
      <slot></slot>

      <div class="mt-5 is-flex">
        <button v-if="!isLast" class="button is-primary mr-2" @click.prevent="$emit('nextStep')">
          {{ $t('game.form.step.nextButton') }}
        </button>
        <button v-else type="submit" class="button is-primary mr-2">
          {{ $t('common.submit') }}
        </button>
        <button v-if="!isFirst" class="button" @click.prevent="$emit('previousStep')">
          {{ $t('game.form.step.previousButton') }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'game-form-step',
    props: {
      number: {
        type: Number,
        required: true
      },
      heading: {
        type: String,
        default: null
      },
      isFirst: {
        type: Boolean,
        default: false
      },
      isLast: {
        type: Boolean,
        default: false
      },
      isCurrentStep: {
        type: Boolean,
        default: true
      }
    },
    computed: {
      isInViewport () {
        // TODO
        return false
        /*const el = this.$refs.root.$el
        const top = el.offsetTop;

        return top >= window.pageYOffset*/
      }
    }
  }
</script>

<style scoped lang="scss">
  @import '../../../assets/scss/variables';

  .game-form-step {
    position: relative;
    opacity: 0.5;

    &.is-current-step, &.is-in-viewport {
      opacity: 1;
    }

    .game-form-step-number {
      background: $primary;
      color: white;
      font-size: 1.5rem;
      font-weight: bold;
      line-height: 1;
      width: 3rem;
      height: 3rem;
      text-align: center;
      padding: 0.75rem 0;
      border-radius: 1.2rem;
      margin-right: 1.5rem;
      margin-top: 2rem;

      &:hover {
        cursor: pointer;
      }

      &:after {
        background: $primary-light;
        position: absolute;
        top: 0;
        height: 100%;
        width: 0.1rem;
        left: 1.45rem;
        display: block;
        content: '';
        z-index: -1;
      }
    }

    .game-form-step-content {
      margin: 2rem 0;

      .game-form-step-heading {
        font-size: 1.5rem;
        line-height: 2;
        color: $primary;
        font-weight: bold;
        margin-bottom: 1rem;

        &:hover {
          cursor: pointer;
        }
      }
    }
  }
</style>