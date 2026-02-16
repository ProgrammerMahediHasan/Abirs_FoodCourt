import http from './http'

export function submitOrder(payload) {
  return http.post('/api/orders', payload)
}

