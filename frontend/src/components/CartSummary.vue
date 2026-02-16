<script setup>
import { computed } from 'vue'
import { useCartStore } from '../stores/cart'

const cartStore = useCartStore()

const items = computed(() => cartStore.items)
const subtotal = computed(() => cartStore.subtotal)
const total = computed(() => cartStore.total)

function updateQuantity(id, value) {
  const quantity = Number(value)
  cartStore.updateQuantity(id, quantity)
}

function removeItem(id) {
  cartStore.removeFromCart(id)
}
</script>

<template>
  <div>
    <h2 class="h4 mb-3">Cart</h2>
    <div v-if="!items.length" class="text-muted">
      Cart is empty.
    </div>
    <div v-else>
      <ul class="list-group mb-3">
        <li
          v-for="item in items"
          :key="item.id"
          class="list-group-item d-flex align-items-center"
        >
          <img
            v-if="item.image"
            :src="item.image"
            :alt="item.name"
            width="60"
            height="60"
            class="me-3 rounded"
            style="object-fit: cover"
          />
          <div class="flex-grow-1">
            <div class="fw-semibold">
              {{ item.name }}
            </div>
            <div class="text-muted small">
              ৳{{ Number(item.price).toFixed(2) }}
            </div>
          </div>
          <div class="d-flex align-items-center">
            <input
              :value="item.quantity"
              type="number"
              min="1"
              class="form-control form-control-sm me-2"
              style="width: 70px"
              @input="updateQuantity(item.id, $event.target.value)"
            />
            <button
              type="button"
              class="btn btn-outline-danger btn-sm"
              @click="removeItem(item.id)"
            >
              ×
            </button>
          </div>
        </li>
      </ul>
      <div class="d-flex justify-content-between">
        <span class="fw-semibold">Total</span>
        <span class="fw-bold">
          ৳{{ Number(total).toFixed(2) }}
        </span>
      </div>
    </div>
  </div>
</template>

