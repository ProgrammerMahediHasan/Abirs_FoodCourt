import http from './http'

export function fetchProducts() {
  return http.get('/api/products')
}

