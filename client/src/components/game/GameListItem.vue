<template>
<div class="game-list-item card">
  <router-link :to="`/game/${game.id}`">
    <div class="card-content">
      <h3 class="subtitle">{{ game.name }}</h3>
      <div class="content">
        <div>
          {{ location.name }}<br/>
        </div>
        <div>
          {{ game.start_date|moment('YYYY-MM-DD') }}<br/>
          {{ game.start_date|moment('HH:mm') }} – {{ game.end_date|moment('HH:mm') }}
        </div>
      </div>
    </div>
  </router-link>
</div>
</template>

<script>
export default {
  name: 'game-list-item',
  props: {
    game: {
      type: Object,
      required: true
    }
  },
  computed: {
    location () {
      if (this.game.venue) {
        return {
          ...this.game.venue.location,
          name: this.game.venue.name
        }
      }

      return {
        ...this.game.location,
        name: this.game.location.name
      }
    }
  }
}
</script>

<style scoped lang="scss">
@import '../../assets/scss/variables';

.game-list-item {
  margin-right: 1em;
  margin-bottom: 1em;
  border-radius: 1em;
  border: 0.2em solid transparent;
  transition: border 0.2s ease;

  &:hover {
    border-color: $primary;
  }

  a {
    color: inherit;
  }
}
</style>