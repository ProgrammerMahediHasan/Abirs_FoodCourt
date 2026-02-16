import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: [],
  }),
  getters: {
    itemCount(state) {
      return state.items.reduce((sum, item) => sum + item.quantity, 0)
    },
    subtotal(state) {
      return state.items.reduce(
        (sum, item) => sum + item.quantity * item.price,
        0,
      )
    },
    tax(state) {
      return state.items.length ? state.items.reduce(() => 0, 0) : 0
    },
    total(state) {
      return state.items.length ? state.items.reduce(() => 0, 0) + state.items.reduce(
        (sum, item) => sum + item.quantity * item.price,
        0,
      ) : 0
    },
  },
  actions: {
    addToCart(product) {
      const existing = this.items.find((item) => item.id === product.id)
      if (existing) {
        existing.quantity += 1
      } else {
        this.items.push({
          id: product.id,
          name: product.name,
          price: product.price,
          image: product.image_url || product.image,
          quantity: 1,
        })
      }
    },
    updateQuantity(id, quantity) {
      const item = this.items.find((i) => i.id === id)
      if (!item) return
      if (quantity <= 0) {
        this.removeFromCart(id)
      } else {
        item.quantity = quantity
      }
    },
    removeFromCart(id) {
      this.items = this.items.filter((item) => item.id !== id)
    },
    clearCart() {
      this.items = []
    },
  },
})

