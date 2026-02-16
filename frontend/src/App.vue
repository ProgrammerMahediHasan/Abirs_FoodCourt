<script setup>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
import { useAuthStore } from './stores/auth'
import { useRoute } from 'vue-router'
import { computed, watchEffect } from 'vue'

const authStore = useAuthStore()
const route = useRoute()

const isAuthPage = computed(() =>
  ['login', 'register'].includes(route.name),
)

watchEffect(() => {
  if (isAuthPage.value) {
    document.body.classList.add('no-scroll')
  } else {
    document.body.classList.remove('no-scroll')
  }
})
</script>

<template>
  <div class="min-vh-100 d-flex flex-column">
    <Navbar v-if="!isAuthPage" />
    <main :class="['flex-grow-1', { 'py-4': !isAuthPage }]">
      <div :class="isAuthPage ? '' : 'container'">
        <div
          v-if="authStore.success && !isAuthPage"
          class="alert alert-success alert-dismissible fade show"
          role="alert"
        >
          {{ authStore.success }}
          <button
            type="button"
            class="btn-close"
            aria-label="Close"
            @click="authStore.clearSuccess()"
          />
        </div>
        <router-view />
      </div>
    </main>
    <Footer v-if="!isAuthPage" />
  </div>
</template>

<style>
body.no-scroll {
  overflow: hidden;
}

.btn-add-to-cart {
  background-color: #ff7f50;
  border-color: #ff7f50;
  color: #fff;
}

.btn-add-to-cart:hover,
.btn-add-to-cart:focus {
  background-color: #ff6a38;
  border-color: #ff6a38;
  color: #fff;
}

.btn-primary,
.btn-success,
.btn-warning {
  background-color: #ff7f50;
  border-color: #ff7f50;
}

.btn-primary:hover,
.btn-primary:focus,
.btn-success:hover,
.btn-success:focus,
.btn-warning:hover,
.btn-warning:focus {
  background-color: #ff6a38;
  border-color: #ff6a38;
}

.btn-outline-secondary,
.btn-outline-danger {
  color: #fff;
  background-color: #ff7f50;
  border-color: #ff7f50;
}

.btn-outline-secondary:hover,
.btn-outline-secondary:focus,
.btn-outline-danger:hover,
.btn-outline-danger:focus {
  color: #fff;
  background-color: #ff6a38;
  border-color: #ff6a38;
}

.btn-light {
  background-color: #ff7f50;
  border-color: #ff7f50;
  color: #fff;
}

.btn-light:hover,
.btn-light:focus {
  background-color: #ff6a38;
  border-color: #ff6a38;
  color: #fff;
}

.navbar .btn-light {
  background-color: #fff;
  border-color: #fff;
  color: #000;
}

.navbar .btn-outline-light {
  border-color: #fff;
  color: #fff;
}

.navbar .btn-outline-light:hover,
.navbar .btn-outline-light:focus {
  background-color: #fff;
  color: #000;
}

.btn-link {
  color: #ff7f50;
}

.btn-link:hover,
.btn-link:focus {
  color: #ff6a38;
}
</style>
