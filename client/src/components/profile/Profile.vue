<template>
  <div class="profile">
    <section class="profile-intro"></section>

    <section class="profile-details">
      <div class="profile-avatar">
        <img v-if="user.avatar" :src="user.avatar">
        <div v-else class="profile-avatar-default"></div>
      </div>

      <div class="profile-name">
        {{ user.firstname }} {{ user.lastname }}
      </div>

      <div class="profile-stats level">
        <div class="level-item has-text-centered">
          <div>
            <p class="heading">{{ $t('profile.stats.gamesAttended') }}</p>
            <p class="title">{{ stats.gamesAttended }}</p>
          </div>
        </div>

        <div class="level-item has-text-centered">
          <div>
            <p class="heading">{{ $t('profile.stats.gamesHosted') }}</p>
            <p class="title">{{ stats.gamesHosted }}</p>
          </div>
        </div>

        <div class="level-item has-text-centered">
          <div>
            <p class="heading">{{ $t('profile.stats.memberSince') }}</p>
            <p class="title">{{ user.created_at|moment('YYYY-MM-DD') }}</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import {mapState} from 'vuex';

export default {
  name: 'profile',
  computed: {
    ...mapState({
      currentUser: state => state.currentUser
    })
  },
  data () {
    return {
      user: null,
      stats: {
        gamesAttended: 0,
        gamesHosted: 0
      }
    }
  },
  async mounted () {
    if (this.$route.params.id && this.$route.params.id !== this.currentUser.id) {
      this.user = await this.$store.dispatch('user/get', this.$route.params.id)
    } else {
      this.user = this.currentUser
    }
  }
}
</script>

<style scoped lang="scss">
@import '../../assets/scss/variables';

.profile {
  .profile-intro {
    margin: -1em -2em;
    background: $primary-light;
    height: 10em;
  }

  .profile-details {
    margin-top: -5em !important;
    text-align: center;

    .profile-avatar {
      margin: 0 auto;
      width: 10em;
      height: 10em;
      border-radius: 2em;
      border: 0.25em solid white;
      overflow: hidden;

      .profile-avatar-default {
        width: 100%;
        height: 100%;
        background: $primary;
      }
    }

    .profile-name {
      font-size: 2em;
      font-weight: bold;
      margin-top: 0.25em;
    }

    .profile-stats {
      margin-top: 1em;
    }
  }
}
</style>