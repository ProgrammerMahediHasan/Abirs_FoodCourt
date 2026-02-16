<script setup>
import { computed } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useCartStore } from '../stores/cart'
import { useAuthStore } from '../stores/auth'

const router = useRouter()
const route = useRoute()
const cartStore = useCartStore()
const authStore = useAuthStore()

const itemCount = computed(() => cartStore.itemCount)
const logoUrl = 'http://localhost/Abirs_FoodCourt/public/assets/images/logo.svg'

function goTo(path) {
  if (route.path !== path) {
    router.push(path)
  }
}

function isActive(path) {
  return route.path === path
}

async function handleLogout() {
  await authStore.logout()
  router.push('/')
}
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-light app-navbar">
    <div class="container-fluid">
      <button
        class="navbar-brand btn btn-link d-flex align-items-center app-brand"
        type="button"
        @click="goTo('/')"
      >
        <img
          :src="logoUrl"
          alt="Abir's FoodCourt"
          class="navbar-logo me-2"
        />
        <!-- Abir's FoodCourt -->
      </button>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#mainNavbar"
        aria-controls="mainNavbar"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon" />
      </button>

      <div
        id="mainNavbar"
        class="collapse navbar-collapse"
      >
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <button
              class="nav-link btn btn-link"
              :class="{ active: isActive('/') }"
              type="button"
              @click="goTo('/')"
            >
              Home
            </button>
          </li>
          <li class="nav-item">
            <button
              class="nav-link btn btn-link"
              :class="{ active: isActive('/about') }"
              type="button"
              @click="goTo('/about')"
            >
              About Us
            </button>
          </li>
          <li class="nav-item">
            <button
              class="nav-link btn btn-link"
              :class="{ active: isActive('/products') }"
              type="button"
              @click="goTo('/products')"
            >
              Products
            </button>
          </li>
          <li class="nav-item">
            <button
              class="nav-link btn btn-link"
              :class="{ active: isActive('/pages') }"
              type="button"
              @click="goTo('/pages')"
            >
              Pages
            </button>
          </li>
          <li class="nav-item">
            <button
              class="nav-link btn btn-link"
              :class="{ active: isActive('/blogs') }"
              type="button"
              @click="goTo('/blogs')"
            >
              Blogs
            </button>
          </li>
          <li class="nav-item">
            <button
              class="nav-link btn btn-link"
              :class="{ active: isActive('/contact') }"
              type="button"
              @click="goTo('/contact')"
            >
              Contact Us
            </button>
          </li>
        </ul>

        <div class="d-flex align-items-center gap-2">
          <button
            class="btn btn-warning me-2"
            type="button"
            @click="goTo('/checkout')"
          >
            Cart
            <span class="badge bg-dark ms-1">{{ itemCount }}</span>
          </button>

          <div
            v-if="authStore.isAuthenticated"
            class="d-flex align-items-center gap-2"
          >
            <span class="app-user-text">
              Welcome, <strong>{{ authStore.user?.name }}</strong>
            </span>
            <button
              class="btn btn-sm btn-logout"
              type="button"
              @click="handleLogout"
              :disabled="authStore.loading"
            >
              {{ authStore.loading ? 'Logging out...' : 'Logout' }}
            </button>
          </div>
          <div
            v-else
            class="d-flex gap-2"
          >
            <button
              class="btn btn-outline-light"
              type="button"
              @click="goTo('/login')"
            >
              Login
            </button>
            <button
              class="btn btn-light"
              type="button"
              @click="goTo('/register')"
            >
              Register
            </button>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<style scoped>
.app-navbar {
  background-color: #ff7f50;
}

.navbar-logo {
  height: 32px;
  width: auto;
}

.app-brand {
  color: #000;
  font-weight: 600;
  text-decoration: none;
}

.gap-2 {
  gap: 0.5rem;
}

.nav-link.btn {
  color: rgba(0, 0, 0, 0.7);
}

.nav-link.btn.active {
  color: #000;
  font-weight: 600;
  border-bottom: 2px solid #000;
}

.app-user-text {
  color: #000;
}

.btn-logout {
  border-color: #000;
  color: #000;
  background-color: transparent;
}

.btn-logout:hover,
.btn-logout:focus {
  background-color: #000;
  color: #fff;
}
</style>
