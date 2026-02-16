<script setup>
import { computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()

const orderId = computed(() => route.params.orderId)

function goHome() {
  router.push('/')
}
</script>

<template>
  <div class="text-center py-5">
    <h1 class="mb-3">Order Successful</h1>
    <p class="lead">
      Your order ID is
      <strong>{{ orderId }}</strong>.
    </p>
    <p class="mb-4">
      Thank you for ordering from Abir's FoodCourt.
    </p>
    <button
      type="button"
      class="btn btn-primary"
      @click="goHome"
    >
      Back to Home
    </button>
  </div>
</template>

