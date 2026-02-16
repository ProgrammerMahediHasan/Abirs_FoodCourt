import { defineStore } from 'pinia'
import { ref } from 'vue'
import authAPI from '../api/auth'

export const useAuthStore = defineStore('auth', () => {
  const user = ref(null)
  const isAuthenticated = ref(false)
  const loading = ref(false)
  const error = ref('')
  const token = ref(localStorage.getItem('auth_token') || '')
  const success = ref('')

  // Check if user is already logged in (on app init)
  async function checkAuth() {
    if (!token.value) {
      user.value = null
      isAuthenticated.value = false
      success.value = ''
      return
    }

    loading.value = true
    try {
      const response = await authAPI.getUser()
      user.value = response.data
      isAuthenticated.value = true
      error.value = ''
    } catch (err) {
      user.value = null
      isAuthenticated.value = false
    } finally {
      loading.value = false
    }
  }

  // Register new customer
  async function register(data) {
    loading.value = true
    error.value = ''
    try {
      const response = await authAPI.register(data)
      user.value = response.data.user || response.data
      token.value = response.data.token
      if (token.value) {
        localStorage.setItem('auth_token', token.value)
      }
      isAuthenticated.value = true
      success.value = 'Registration successful'
      return response.data
    } catch (err) {
      error.value = err.response?.data?.message || err.message || 'Registration failed'
      throw error.value
    } finally {
      loading.value = false
    }
  }

  // Login customer
  async function login(username, password) {
    loading.value = true
    error.value = ''
    try {
      const response = await authAPI.login(username, password)
      user.value = response.data.user || response.data
      token.value = response.data.token
      if (token.value) {
        localStorage.setItem('auth_token', token.value)
      }
      isAuthenticated.value = true
      success.value = ''
      return response.data
    } catch (err) {
      error.value = err.response?.data?.message || err.message || 'Login failed'
      throw error.value
    } finally {
      loading.value = false
    }
  }

  // Logout customer
  async function logout() {
    loading.value = true
    try {
      if (token.value) {
        await authAPI.logout()
      }
      user.value = null
      isAuthenticated.value = false
      error.value = ''
      token.value = ''
      localStorage.removeItem('auth_token')
      success.value = ''
    } catch (err) {
      error.value = err.response?.data?.message || err.message || 'Logout failed'
    } finally {
      loading.value = false
    }
  }

  // Clear error
  function clearError() {
    error.value = ''
  }

  function clearSuccess() {
    success.value = ''
  }

  return {
    user,
    isAuthenticated,
    loading,
    error,
    token,
    success,
    checkAuth,
    register,
    login,
    logout,
    clearError,
    clearSuccess,
  }
})
