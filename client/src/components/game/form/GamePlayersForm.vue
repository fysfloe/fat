<template>
  <div class="game-players-form columns">
    <div class="column">
      <input-group
          :label="$t('game.form.players.numPlayers')"
          name="players.numPlayers"
          v-model="game.num_players"
          type="number"
          :min="2"
      />

      <input-group
          :label="$t('game.form.players.canInvite')"
          name="players.canInvite"
          v-model="game.players_can_invite"
          type="checkbox"
      />

      <autocomplete
          :label="$t('game.form.players.invitePlayers')"
          name="players.invitePlayers"
          @input="addInvitee"
          url="/user/autocomplete"
          :disabled="game.num_players && game.num_players <= game.players.length + game.invitees.length"
      />
    </div>
    <div class="column">
      <div class="game-players-lists">
        <div class="game-players-list">
          <h3>{{ $t('game.form.players.inviteeList') }}</h3>
          <ul class="game-players-invitee-list" v-if="game.invitees.length > 0">
            <li v-for="invitee in game.invitees" :key="invitee">
              <user-item :user="invitee" />
            </li>
          </ul>
          <em v-else>{{ $t('game.form.players.noInvitees') }}</em>
        </div>

        <div class="game-players-list">
          <h3>{{ $t('game.form.players.playersList') }}</h3>
          <ul class="game-players-players-list" v-if="game.players.length > 0">
            <li v-for="player in game.players" :key="player.handle">
              <user-item :user="player" />
            </li>
          </ul>
          <em v-else>{{ $t('game.form.players.noPlayers') }}</em>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import InputGroup from "../../basic/InputGroup";
  import Autocomplete from '@/components/basic/Autocomplete';
  import UserItem from '@/components/user/UserItem';

  export default {
    name: 'game-players-form',
    components: {UserItem, Autocomplete, InputGroup},
    props: {
      game: {
        type: Object,
        required: true
      }
    },
    data () {
      return {
      }
    },
    computed: {

    },
    methods: {
      async addInvitee (user) {
        if (user.value) {
          if (!this.game.players.some(invitee => invitee.handle === user.value)) {
            const response = await this.$store.dispatch('user/get', user.value)

            this.game.players.push(response.data.data)
          }
        } else {
          if (!this.game.invitees.includes(user.name)) {
            this.game.invitees.push(user.name)
          }
        }
      }
    }
  }
</script>

<style scoped lang="scss">
.game-players-form {
  .game-players-lists {
    .game-players-list {
      margin-bottom: 1em;

      h3 {
        margin-bottom: 0.25em;
        font-weight: bold;
      }
    }
  }
}
</style>