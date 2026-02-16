<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useCartStore } from '../stores/cart'
import { useAuthStore } from '../stores/auth'
import CartSummary from '../components/CartSummary.vue'
import { submitOrder } from '../api/orders'

const router = useRouter()
const cartStore = useCartStore()
const authStore = useAuthStore()

const name = ref('')
const phone = ref('')
const address = ref('')
const loading = ref(false)
const error = ref('')

const hasItems = computed(() => cartStore.items.length > 0)
const total = computed(() => cartStore.total)

// Pre-fill user information on mount
onMounted(() => {
  if (authStore.user) {
    name.value = authStore.user.name || ''
    phone.value = authStore.user.phone || ''
  }
})

async function handleSubmit() {
  if (!hasItems.value) {
    error.value = 'Cart is empty.'
    return
  }
  if (!name.value || !phone.value || !address.value) {
    error.value = 'All fields are required.'
    return
  }

  loading.value = true
  error.value = ''
  try {
    const payload = {
      user_id: authStore.user?.id,
      customer: {
        name: name.value,
        phone: phone.value,
        address: address.value,
      },
      items: cartStore.items.map((item) => ({
        menu_id: item.id,
        quantity: item.quantity,
        unit_price: item.price,
      })),
      total: total.value,
    }

    const response = await submitOrder(payload)
    const orderId = response.data.id || response.data.order_id

    cartStore.clearCart()

    if (orderId) {
      router.push({
        name: 'order-success',
        params: { orderId: String(orderId) },
        state: {
          summary: {
            items: payload.items,
            total: payload.total,
          },
        },
      })
    } else {
      router.push('/order-success/unknown')
    }
  } catch (e) {
    error.value =
      e.response?.data?.message ||
      e.message ||
      'Failed to submit order.'
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div class="row">
    <div class="col-md-7 mb-4">
      <h1 class="mb-4">Checkout</h1>
      <form @submit.prevent="handleSubmit">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input
            v-model="name"
            type="text"
            class="form-control"
            placeholder="Customer name"
          />
        </div>
        <div class="mb-3">
          <label class="form-label">Phone</label>
          <input
            v-model="phone"
            type="text"
            class="form-control"
            placeholder="Phone number"
          />
        </div>
        <div class="mb-3">
          <label class="form-label">Address</label>
          <textarea
            v-model="address"
            rows="3"
            class="form-control"
            placeholder="Delivery address"
          />
        </div>
        <div v-if="error" class="alert alert-danger">
          {{ error }}
        </div>
        <button
          type="submit"
          class="btn btn-success"
          :disabled="loading"
        >
          <span v-if="loading">Placing order...</span>
          <span v-else>Confirm Order</span>
        </button>
      </form>
    </div>
    <div class="col-md-5">
      <CartSummary />
    </div>
  </div>
</template>

