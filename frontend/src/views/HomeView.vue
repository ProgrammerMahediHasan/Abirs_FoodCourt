<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRouter } from 'vue-router'
import { fetchProducts } from '../api/products'
import { useCartStore } from '../stores/cart'
import { useAuthStore } from '../stores/auth'

const products = ref([])
const loading = ref(false)
const error = ref('')
const search = ref('')
const selectedCategory = ref('')

const router = useRouter()
const cartStore = useCartStore()
const authStore = useAuthStore()

const categories = computed(() => {
  const names = products.value
    .map((p) => p.category || p.category_name)
    .filter((name) => !!name)
  return Array.from(new Set(names))
})

const filteredProducts = computed(() => {
  return products.value.filter((product) => {
    const matchesCategory =
      !selectedCategory.value ||
      product.category === selectedCategory.value ||
      product.category_name === selectedCategory.value
    const term = search.value.toLowerCase()
    const matchesSearch =
      !term ||
      product.name.toLowerCase().includes(term) ||
      (product.description || '')
        .toLowerCase()
        .includes(term)
    return matchesCategory && matchesSearch
  })
})

function addToCart(product) {
  if (!authStore.isAuthenticated) {
    router.push({
      name: 'login',
      query: { redirect: '/checkout' },
    })
    return
  }

  cartStore.addToCart(product)
}

async function loadProducts() {
  loading.value = true
  error.value = ''
  try {
    const response = await fetchProducts()
    products.value = response.data
  } catch (e) {
    error.value =
      e.response?.data?.message ||
      e.message ||
      'Failed to load products'
  } finally {
    loading.value = false
  }
}

onMounted(loadProducts)
</script>

<template>
  <div>
    <h1 class="mb-4">Menu</h1>

    <div class="row mb-3">
      <div class="col-md-4 mb-2">
        <input
          v-model="search"
          type="text"
          class="form-control"
          placeholder="Search menu"
        />
      </div>
      <div class="col-md-4 mb-2">
        <select
          v-model="selectedCategory"
          class="form-select"
        >
          <option value="">All Categories</option>
          <option
            v-for="category in categories"
            :key="category"
            :value="category"
          >
            {{ category }}
          </option>
        </select>
      </div>
    </div>

    <div v-if="loading" class="text-center py-5">
      Loading products...
    </div>
    <div v-else-if="error" class="alert alert-danger">
      {{ error }}
    </div>
    <div v-else-if="!filteredProducts.length" class="text-muted">
      No products found.
    </div>
    <div v-else class="row">
      <div
        v-for="product in filteredProducts"
        :key="product.id"
        class="col-md-4 mb-4"
      >
        <div class="card h-100">
          <img
            v-if="product.image_url"
            :src="product.image_url"
            :alt="product.name"
            class="card-img-top"
            style="height: 200px; object-fit: cover"
          />
          <div
            v-else
            class="bg-light d-flex align-items-center justify-content-center"
            style="height: 200px"
          >
            <span class="text-muted">No Image</span>
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">
              {{ product.name }}
            </h5>
            <p class="card-text text-muted">
              {{ product.category || product.category_name }}
            </p>
            <p class="card-text fw-bold mb-3">
              ৳{{ Number(product.price).toFixed(2) }}
            </p>
            <button
              type="button"
              class="btn btn-add-to-cart mt-auto"
              @click="addToCart(product)"
            >
              Add to Cart
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
