<script setup>
import { ref } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useAuthStore } from '../stores/auth'

const router = useRouter()
const route = useRoute()
const authStore = useAuthStore()
const logoUrl = 'http://localhost/Abirs_FoodCourt/public/assets/images/logo.svg'

const username = ref('')
const email = ref('')
const phone = ref('')
const password = ref('')
const passwordConfirm = ref('')
const showPassword = ref(false)

async function handleRegister() {
  if (password.value !== passwordConfirm.value) {
    authStore.error = 'Passwords do not match'
    return
  }

  try {
    await authStore.register({
      username: username.value,
      email: email.value,
      phone: phone.value,
      password: password.value,
      passwordConfirm: passwordConfirm.value,
    })
    const redirectTo = route.query.redirect || '/'
    router.push(redirectTo)
  } catch (err) {
    // Error is already set in authStore.error
  }
}

function toggleShowPassword() {
  showPassword.value = !showPassword.value
}

function goToLogin() {
  const query = {}
  if (route.query.redirect) {
    query.redirect = route.query.redirect
  }

  router.push({ name: 'login', query })
}
</script>

<template>
  <div class="auth-page">
    <div class="auth-inner">
      <div class="row g-0">
        <div class="col-lg-6 d-none d-lg-flex align-items-center">
          <div class="auth-hero w-100">
            <div class="auth-hero-header mb-4 text-center text-lg-start">
              <img
                :src="logoUrl"
                alt="Abir's FoodCourt"
                class="auth-logo-img mb-3"
              />
              <h2 class="mb-1 auth-hero-title">Create your Abir's FoodCourt account</h2>
            </div>
            <p class="mb-4">
              Register in a minute and enjoy a faster, more personalized ordering experience.
            </p>
            <ul class="auth-list">
              <li>Save your name and phone for future orders.</li>
              <li>Access the dashboard and track your active cart.</li>
              <li>Use the same account from any device.</li>
            </ul>
          </div>
        </div>

        <div class="col-lg-6 d-flex justify-content-center">
          <div class="auth-card card shadow-sm">
            <div class="card-body p-4 p-md-5">
              <h2 class="card-title text-center mb-2">Create Account</h2>
              <p class="text-center text-muted small mb-4">
                Enter your details below to get started with Abir's FoodCourt.
              </p>

              <div
                v-if="authStore.error"
                class="alert alert-danger"
                role="alert"
              >
                {{ authStore.error }}
              </div>

              <form @submit.prevent="handleRegister">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label
                      for="username"
                      class="form-label"
                    >Username</label>
                    <input
                      id="username"
                      v-model="username"
                      type="text"
                      class="form-control"
                      placeholder="Username"
                      required
                    />
                  </div>

                  <div class="col-md-6 mb-3">
                    <label
                      for="email"
                      class="form-label"
                    >Email</label>
                    <input
                      id="email"
                      v-model="email"
                      type="email"
                      class="form-control"
                      placeholder="you@example.com"
                      required
                    />
                  </div>
                </div>

                <div class="mb-3">
                  <label
                    for="phone"
                    class="form-label"
                  >Phone Number</label>
                  <input
                    id="phone"
                    v-model="phone"
                    type="tel"
                    class="form-control"
                    placeholder="+880 1XXXXXXXXX"
                    required
                  />
                </div>

                <div class="mb-3">
                  <label
                    for="password"
                    class="form-label"
                  >Password</label>
                  <div class="input-group">
                    <input
                      id="password"
                      v-model="password"
                      :type="showPassword ? 'text' : 'password'"
                      class="form-control"
                      placeholder="Enter a strong password"
                      required
                    />
                    <button
                      type="button"
                      class="btn btn-outline-secondary"
                      @click="toggleShowPassword"
                    >
                      <i :class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                    </button>
                  </div>
                </div>

                <div class="mb-3">
                  <label
                    for="passwordConfirm"
                    class="form-label"
                  >Confirm Password</label>
                  <div class="input-group">
                    <input
                      id="passwordConfirm"
                      v-model="passwordConfirm"
                      :type="showPassword ? 'text' : 'password'"
                      class="form-control"
                      placeholder="Confirm your password"
                      required
                    />
                    <button
                      type="button"
                      class="btn btn-outline-secondary"
                      @click="toggleShowPassword"
                    >
                      <i :class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                    </button>
                  </div>
                </div>

                <button
                  type="submit"
                  class="btn btn-primary w-100 mb-3"
                  :disabled="authStore.loading"
                >
                  <span
                    v-if="authStore.loading"
                    class="spinner-border spinner-border-sm me-2"
                  />
                  {{ authStore.loading ? 'Creating Account...' : 'Register' }}
                </button>
              </form>

              <div class="text-center">
                <p class="mb-0">Already have an account?</p>
                <button
                  type="button"
                  class="btn btn-link p-0"
                  @click="goToLogin"
                >
                  Login here
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.auth-page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #fff7f2, #ffe1d1);
}

.auth-inner {
  width: 100%;
}

.auth-hero {
  padding: 2.5rem 2.25rem;
  border-radius: 1rem;
  background: linear-gradient(135deg, #ff7b54, #ffb26b);
  color: #fff;
  margin-right: 1.5rem;
}

.auth-hero-title {
  font-weight: 600;
  font-size: 1.6rem;
}

.auth-logo-img {
  height: 52px;
  width: auto;
}

.auth-hero h2 {
  font-weight: 600;
}

.auth-list {
  padding-left: 1.25rem;
  margin-bottom: 0;
  font-size: 0.95rem;
}

.auth-card {
  max-width: 460px;
  width: 100%;
  border: none;
  border-radius: 1rem;
  background-color: #ffffff;
}

@media (max-width: 991.98px) {
  .auth-page {
    min-height: auto;
    padding-top: 1rem;
    padding-bottom: 2rem;
  }

  .auth-card {
    margin: 0 auto;
  }
}
</style>
