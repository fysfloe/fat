<template>
  <div class="user-item">
    <div class="user-info">
      <div class="user-avatar">
        <img v-if="isUserObject && user.avatar" :src="user.avatar" :alt="`${user.firstname} ${user.lastname}`">
        <div v-else class="user-avatar-default"></div>
      </div>
      <span class="user-name">
        <span v-if="isUserObject">{{ user.firstname }} {{ user.lastname }}</span>
        <span v-else>{{ user }}</span>
      </span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'user-item',
  props: {
    user: {
      type: [Object, String],
      required: true
    }
  },
  computed: {
    isUserObject () {
      return typeof this.user === 'object'
    }
  }
}
</script>

<style scoped lang="scss">
@import '../../assets/scss/variables';

.user-info {
  display: flex;
  align-items: center;

  .user-avatar {
    width: 2em;
    height: 2em;
    border-radius: 0.5em;
    overflow: hidden;
    margin-right: 0.5em;

    .user-avatar-default {
      width: 100%;
      height: 100%;
      background: $primary;
    }
  }
}
</style>