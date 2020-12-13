<template>
  <div class="login-form">
    <h2 class="title">Login</h2>

    <form @submit.prevent="login">
      <div v-if="error" class="notification is-danger">
        {{ error }}
      </div>

      <input-group
              label="E-mail"
              name="email"
              type="email"
              v-model="email"
              required
      />

      <input-group
              label="Password"
              name="password"
              type="password"
              v-model="password"
              required
      />

      <button class="button is-primary" type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import InputGroup from '../basic/InputGroup'
export default {
  name: 'login',
  components: { InputGroup },
  data () {
    return {
      email: null,
      password: null,
      error: null
    }
  },
  methods: {
    async login () {
      try {
        await this.$store.dispatch('login', { email: this.email, password: this.password })
        this.$router.push('/')
      } catch (error) {
        this.error = error.response.data.message
      }
    }
  }
}
</script>
