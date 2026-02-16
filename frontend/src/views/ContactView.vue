<script setup>
import { ref } from 'vue'

const contactCards = [
  {
    label: 'Call Us',
    value: '+880 1632606827',
  },
  {
    label: 'Email',
    value: 'abirsfoodcourt@gmail.com',
  },
  {
    label: 'Location',
    value: 'Dhaka, Bangladesh',
  },
  {
    label: 'Working Hours',
    value: 'Everyday, 10:00 AM – 11:00 PM',
  },
]

const name = ref('')
const email = ref('')
const message = ref('')
const sending = ref(false)
const success = ref('')

function resetForm() {
  name.value = ''
  email.value = ''
  message.value = ''
}

async function handleSubmit() {
  if (!name.value || !email.value || !message.value) {
    success.value = ''
    return
  }

  sending.value = true
  success.value = ''

  setTimeout(() => {
    sending.value = false
    success.value = 'Thanks for your message. We will get back to you soon.'
    resetForm()
  }, 600)
}
</script>

<template>
  <div class="contact-page py-5">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-8">
          <h5 class="text-uppercase text-muted mb-2">Contact Us</h5>
          <h1 class="fw-bold mb-3">
            We are here to help with your orders
          </h1>
          <p class="text-muted mb-0">
            Reach out if you have questions about your order, delivery, or menu items.
          </p>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
          <div class="row">
            <div
              v-for="card in contactCards"
              :key="card.label"
              class="col-sm-6 mb-3"
            >
              <div class="card h-100 shadow-sm border-0 contact-card">
                <div class="card-body">
                  <h6 class="text-muted text-uppercase small mb-1">
                    {{ card.label }}
                  </h6>
                  <p class="mb-0">
                    {{ card.value }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h5 class="mb-3">Send us a message</h5>

              <div
                v-if="success"
                class="alert alert-success py-2"
                role="alert"
              >
                {{ success }}
              </div>

              <form @submit.prevent="handleSubmit">
                <div class="mb-3">
                  <label class="form-label">Name</label>
                  <input
                    v-model="name"
                    type="text"
                    class="form-control"
                    placeholder="Your name"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input
                    v-model="email"
                    type="email"
                    class="form-control"
                    placeholder="you@example.com"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label class="form-label">Message</label>
                  <textarea
                    v-model="message"
                    class="form-control"
                    rows="4"
                    placeholder="Your message"
                    required
                  />
                </div>
                <button
                  type="submit"
                  class="btn btn-primary"
                  :disabled="sending"
                >
                  <span
                    v-if="sending"
                    class="spinner-border spinner-border-sm me-2"
                  />
                  {{ sending ? 'Sending...' : 'Send Message' }}
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="contact-map-wrapper shadow-sm">
            <iframe
              src="https://www.google.com/maps?q=Dhaka%2C%20Bangladesh&output=embed"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.contact-page {
  background-color: #fffaf6;
}

.contact-card {
  background-color: #ffffff;
}

.contact-map-wrapper {
  border-radius: 1rem;
  overflow: hidden;
}

.contact-map-wrapper iframe {
  width: 100%;
  height: 260px;
  border: 0;
}
</style>
