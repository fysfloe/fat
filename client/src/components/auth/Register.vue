<template>
  <div class="login-form">
    <h2 class="title">{{ $t('register.title') }}</h2>

    <form @submit.prevent="register">
      <div v-if="error" class="notification is-danger">
        {{ error }}
      </div>

      <input-group
              :label="$t('register.form.firstname')"
              name="firstname"
              type="text"
              v-model="firstname"
              required
      />

      <input-group
              :label="$t('register.form.lastname')"
              name="lastname"
              type="text"
              v-model="lastname"
              required
      />

      <input-group
              :label="$t('register.form.email')"
              name="email"
              type="email"
              v-model="email"
              required
      />

      <input-group
              :label="$t('register.form.password')"
              name="password"
              type="password"
              v-model="password"
              required
      />

      <input-group
              :label="$t('register.form.repeatPassword')"
              name="repeatPassword"
              type="password"
              v-model="repeatPassword"
              required
      />

      <button class="button is-primary" type="submit">{{ $t('register.form.submitButton') }}</button>
    </form>
  </div>
</template>

<script>
import InputGroup from '../basic/InputGroup'

export default {
  name: 'register',
  components: { InputGroup },
  data () {
    return {
      firstname: null,
      lastname: null,
      email: null,
      password: null,
      repeatPassword: null,
      error: null
    }
  },
  methods: {
    async register () {
      if (this.password !== this.repeatPassword) {
        this.error = this.$t('register.form.error.passwordMismatch')

        return
      }

      try {
        await this.$store.dispatch('register', {
          firstname: this.firstname,
          lastname: this.lastname,
          email: this.email,
          password: this.password
        })
      } catch (error) {
        this.error = error.response.data.message
      }

      this.$router.push('/')
    }
  }
}
</script>
