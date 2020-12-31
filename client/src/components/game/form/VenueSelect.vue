<template>
  <div class="venue-select">
    <input-group
            :label="$t('game.form.venue.venue')"
            name="venue.name"
            v-model="venueName"
            @focus="opened = true"
            @focusout="closeDropdown"
            autocomplete="chrome-off"
    />

    <div :class="{'venue-select-dropdown': true, 'active': opened}">
      <ul v-if="venues.length > 0">
        <li @click="selectVenue(venue)" class="venue-select-item" v-for="venue in venues" :key="venue.id">
          <p class="venue-select-item-name">{{ venue.name }}</p>
          <p class="venue-select-item-address">
            {{ venue.location.street }} • {{ venue.location.zip_code }} {{ venue.location.city }} • {{ countries[venue.location.country] }}
          </p>
        </li>
      </ul>

      <span v-else>{{ $t('game.form.venue.select.noItems') }}</span>
    </div>
  </div>
</template>

<script>
  import InputGroup from '../../basic/InputGroup';
  import {mapState} from 'vuex';

  export default {
    name: 'venue-select',
    components: {InputGroup},
    data () {
      return {
        venueName: null,
        opened: false
      }
    },
    computed: {
      ...mapState({
        countries: state => state.countries
      })
    },
    props: {
      venues: {
        type: Array,
        required: true
      },
      game: {
        type: Object,
        required: true
      }
    },
    methods: {
      selectVenue (venue) {
        this.game.venue = venue
        this.game.location = venue.location
        this.venueName = venue.name
        this.opened = false

        this.$emit('venueSelected')
      },
      closeDropdown () {
        setTimeout(() => {
          this.opened = false
        }, 10);
      }
    }
  }
</script>

<style scoped lang="scss">
  @import '../../../assets/scss/variables';

  .venue-select {
    position: relative;

    .venue-select-dropdown {
      display: none;
      box-shadow: 0 0 0.5em 0 lightgrey;
      padding: 0.5em;
      border-radius: 0.5em;
      position: absolute;
      width: 100%;
      background: white;
      z-index: 1;

      &.active {
        display: block;
      }

      .venue-select-item {
        padding: 0.5em;
        border-radius: 0.5em;

        &:hover, &:focus, &:active {
          background: $primary;
          color: white;
          cursor: pointer;
        }

        .venue-select-item-name {
          font-weight: bold;
        }
      }
    }
  }
</style>