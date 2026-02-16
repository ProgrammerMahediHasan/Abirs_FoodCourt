import http from './http'

export const authAPI = {
  // Get CSRF token (required for Sanctum)
  async getCsrfToken() {
    return await http.get('/sanctum/csrf-cookie')
  },

  // Register new customer
  async register(data) {
    return await http.post('/api/register', {
      username: data.username,
      email: data.email,
      phone: data.phone,
      password: data.password,
      password_confirmation: data.passwordConfirm,
    })
  },

  // Login customer
  async login(username, password) {
    return await http.post('/api/login', {
      username,
      password,
    })
  },

  // Get current authenticated user
  async getUser() {
    return await http.get('/api/user')
  },

  // Logout customer
  async logout() {
    return await http.post('/api/logout')
  },

  // Check if user is authenticated
  async checkAuth() {
    try {
      await this.getUser()
      return true
    } catch (error) {
      return false
    }
  },
}

export default authAPI
