<script setup>
import { ref } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useAuthStore } from '../stores/auth'

const router = useRouter()
const route = useRoute()
const authStore = useAuthStore()

const username = ref('')
const password = ref('')
const showPassword = ref(false)

async function handleLogin() {
  try {
    await authStore.login(username.value, password.value)
    const redirectTo = route.query.redirect || '/'
    router.push(redirectTo)
  } catch (err) {
    // Error is already set in authStore.error
  }
}

function toggleShowPassword() {
  showPassword.value = !showPassword.value
}

function goToRegister() {
  const query = {}
  if (route.query.redirect) {
    query.redirect = route.query.redirect
  }

  router.push({ name: 'register', query })
}

function goToForgotPassword() {
  window.open('http://localhost/Abirs_FoodCourt/public/password/reset', '_blank')
}
</script>

<template>
  <div class="login-page">
    <div class="login-content">
      <div class="login-card">
        <div class="login-logo text-center mb-3">
          <img
            src="http://localhost/Abirs_FoodCourt/public/assets/images/logo.svg"
            alt="Abir's FoodCourt"
            class="login-logo-img mb-2"
          />
          <!-- <h2 class="login-title mb-0">Abir's FoodCourt</h2> -->
        </div>

        <h2 class="login-card-title mb-4">Customer Login</h2>

        <div
          v-if="authStore.error"
          class="alert alert-danger"
          role="alert"
        >
          {{ authStore.error }}
        </div>

        <form @submit.prevent="handleLogin">
          <div class="mb-3">
            <div class="login-input">
              <span class="login-input-icon">
                <i class="bi bi-person" />
              </span>
              <input
                id="username"
                v-model="username"
                type="text"
                class="form-control login-input-control"
                placeholder="Username"
                required
              />
            </div>
          </div>

          <div class="mb-3">
            <div class="login-input">
              <span class="login-input-icon">
                <i class="bi bi-lock" />
              </span>
              <input
                id="password"
                v-model="password"
                :type="showPassword ? 'text' : 'password'"
                class="form-control login-input-control"
                placeholder="Password"
                required
              />
              <button
                type="button"
                class="btn btn-outline-secondary login-eye-btn"
                @click="toggleShowPassword"
              >
                <i :class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
              </button>
            </div>
          </div>

          <div class="form-check mb-3">
            <input
              id="showPasswordCheck"
              v-model="showPassword"
              class="form-check-input"
              type="checkbox"
            />
            <label
              class="form-check-label text-muted"
              for="showPasswordCheck"
            >
              Show Password
            </label>
          </div>

          <button
            type="submit"
            class="btn btn-login w-100 mb-3"
            :disabled="authStore.loading"
          >
            <span
              v-if="authStore.loading"
              class="spinner-border spinner-border-sm me-2"
            />
            {{ authStore.loading ? 'SIGNING IN...' : 'SIGN IN' }}
          </button>
        </form>

        <div class="d-flex justify-content-between align-items-center small text-muted">
          <span>keep signed in</span>
          <button
            type="button"
            class="btn btn-link p-0"
            @click="goToForgotPassword"
          >
            forgot password?
          </button>
        </div>

        <div class="text-center mt-4">
          <p class="mb-1 text-muted">Don't have an account?</p>
          <button
            type="button"
            class="btn btn-link p-0"
            @click="goToRegister"
          >
            Create Account
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.login-page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #ff7f50;
}

.login-content {
  width: 100%;
  max-width: 380px;
  padding: 0 1.25rem;
}

.login-card {
  background: #ffffff;
  border-radius: 1rem;
  padding: 1.75rem 1.75rem 1.5rem;
  box-shadow: 0 18px 40px rgba(0, 0, 0, 0.25);
}

.login-card-title {
  font-size: 1.25rem;
  font-weight: 600;
  text-align: center;
  margin-bottom: 1rem;
  color: #333;
}

.login-logo-img {
  height: 56px;
  width: auto;
}

.login-title {
  font-size: 1.1rem;
  font-weight: 600;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  color: #333;
}

.login-input {
  position: relative;
  display: flex;
  align-items: center;
  background-color: #ffffff;
  border-radius: 999px;
  padding-left: 3rem;
  border: 1px solid #ffb89d;
}

.login-input-icon {
  position: absolute;
  left: 1.1rem;
  color: #ff7f50;
  font-size: 1rem;
}

.login-input-control {
  border: none;
  border-radius: 999px;
  padding: 0.6rem 0.9rem;
  box-shadow: none;
  background-color: transparent;
  color: #333;
}

.login-input-control:focus {
  box-shadow: none;
}

.login-eye-btn {
  position: absolute;
  right: 0.35rem;
  border-radius: 999px;
  border: none;
  padding: 0.35rem 0.75rem;
}

.btn-login {
  background-color: #ff7f50;
  border-color: #ff7f50;
  border-radius: 999px;
  padding: 0.65rem 1rem;
  font-weight: 600;
  letter-spacing: 0.08em;
}

.btn-login:hover,
.btn-login:focus {
  background-color: #ff6a38;
  border-color: #ff6a38;
}

@media (max-width: 575.98px) {
  .login-content {
    padding-inline: 1rem;
  }

  .login-card {
    padding-inline: 1.5rem;
  }

  .login-title {
    font-size: 1.6rem;
    letter-spacing: 0.08em;
  }
}
</style>
