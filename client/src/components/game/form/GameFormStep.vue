<template>
  <div class="game-form-step is-flex is-align-items-flex-start">
    <div class="game-form-step-number">
      {{ number }}
    </div>
    <div class="game-form-step-content">
      <h3 class="game-form-step-heading" v-if="heading">{{ heading }}</h3>
      <slot></slot>

      <button class="button is-primary mt-5">{{ $t('game.form.step.nextButton') }}</button>
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
      }
    }
  }
</script>

<style scoped lang="scss">
  @import '../../../assets/scss/variables';

  .game-form-step {
    position: relative;

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
      }
    }
  }
</style>