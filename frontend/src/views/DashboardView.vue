<script setup>
import { computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import { useCartStore } from '../stores/cart'

const router = useRouter()
const authStore = useAuthStore()
const cartStore = useCartStore()

const userName = computed(() => authStore.user?.name || authStore.user?.username || 'Customer')
const cartItemCount = computed(() => cartStore.itemCount)
const cartTotal = computed(() => cartStore.totalPrice)

function goToHome() {
  router.push({ name: 'home' })
}

function goToCheckout() {
  router.push({ name: 'checkout' })
}
</script>

<template>
  <div class="dashboard">
    <section class="dashboard-hero mb-4">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
        <div>
          <h2 class="mb-2">Welcome back, {{ userName }}</h2>
          <p class="mb-0">
            Manage your cart and complete your order in a few simple steps.
          </p>
        </div>
        <div class="mt-3 mt-md-0">
          <button
            type="button"
            class="btn btn-outline-light me-2"
            @click="goToHome"
          >
            Browse Menu
          </button>
          <button
            type="button"
            class="btn btn-light text-primary"
            @click="goToCheckout"
          >
            Go to Checkout
          </button>
        </div>
      </div>
    </section>

    <div class="row mb-4">
      <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <h6 class="text-uppercase text-muted small mb-1">Items in cart</h6>
            <p class="display-6 mb-0">{{ cartItemCount }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <h6 class="text-uppercase text-muted small mb-1">Cart total</h6>
            <p class="display-6 mb-0">৳{{ cartTotal.toFixed(2) }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 h-100 d-flex align-items-center">
          <div class="card-body text-center">
            <h6 class="text-uppercase text-muted small mb-3">Quick action</h6>
            <button
              type="button"
              class="btn btn-primary w-100"
              @click="goToCheckout"
              :disabled="cartItemCount === 0"
            >
              {{ cartItemCount === 0 ? 'Start a new order' : 'Review & place order' }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <h5 class="card-title mb-3">Your current cart</h5>
            <p class="text-muted mb-1">
              You currently have
              <strong>{{ cartItemCount }}</strong>
              item{{ cartItemCount === 1 ? '' : 's' }} in your cart.
            </p>
            <p class="text-muted mb-3">
              Estimated total:
              <strong>৳{{ cartTotal.toFixed(2) }}</strong>
            </p>
            <p class="small text-muted mb-3">
              Add more items from the menu or go to checkout to confirm your delivery details and place the order.
            </p>
            <button
              type="button"
              class="btn btn-outline-secondary me-2"
              @click="goToHome"
            >
              Add more items
            </button>
            <button
              type="button"
              class="btn btn-primary"
              @click="goToCheckout"
              :disabled="cartItemCount === 0"
            >
              {{ cartItemCount === 0 ? 'Cart is empty' : 'Go to checkout' }}
            </button>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <h5 class="card-title mb-3">Tips</h5>
            <ul class="list-unstyled mb-0">
              <li class="mb-2">
                • Browse the menu and add your favourite items to the cart.
              </li>
              <li class="mb-2">
                • From checkout, confirm your delivery details and place the order.
              </li>
              <li class="mb-2">
                • You can log in on any device with the same username and password.
              </li>
              <li>
                • Use the navigation bar to quickly switch between pages or logout.
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.dashboard h2 {
  font-weight: 600;
}

.dashboard-hero {
  border-radius: 1rem;
  padding: 1.75rem 1.5rem;
  background: linear-gradient(135deg, #ff7b54, #ffb26b);
  color: #fff;
}
</style>
