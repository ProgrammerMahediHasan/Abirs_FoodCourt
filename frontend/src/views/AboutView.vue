<script setup>
const featureItems = [
  {
    title: 'Handpicked Menu',
    description: 'A selection of popular and signature dishes for every taste.',
  },
  {
    title: 'Easy Ordering',
    description: 'Add items to cart and confirm your order in a few simple steps.',
  },
  {
    title: 'Secure Account',
    description: 'Login and track your orders with a secure customer dashboard.',
  },
  {
    title: 'Flexible Categories',
    description: 'Filter by category and quickly find the dishes you love.',
  },
]

const statItems = [
  {
    title: 'Fast',
    description: 'Optimized ordering flow for quick checkout and confirmation.',
  },
  {
    title: 'Reliable',
    description: 'Built with Laravel API and Vue frontend for a stable experience.',
  },
  {
    title: 'Customer First',
    description: 'Designed to make ordering simple for every type of customer.',
  },
]
</script>

<template>
  <div class="about-page py-5">
    <div class="container">
      <div class="row align-items-center mb-5">
        <div class="col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase text-muted mb-2">About Us</h5>
          <h1 class="fw-bold mb-3">
            Fresh, Fast &amp; Flavourful Food Experience
          </h1>
          <p class="text-muted mb-3">
            Abir's FoodCourt is a modern online restaurant platform where you can explore a
            curated menu, place orders in a few clicks, and enjoy fast delivery at your doorstep.
          </p>
          <p class="text-muted mb-4">
            We focus on quality ingredients, consistent taste, and a smooth ordering experience
            so that you can spend more time enjoying your meal and less time waiting for it.
          </p>

          <div class="row">
            <div
              v-for="item in featureItems"
              :key="item.title"
              class="col-6 mb-3"
            >
              <div class="d-flex">
                <span class="about-check me-2">✓</span>
                <div>
                  <h6 class="mb-1">{{ item.title }}</h6>
                  <p class="small text-muted mb-0">
                    {{ item.description }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="about-image-wrapper shadow-sm">
            <div class="about-badge">
              24/7
              <span class="small d-block">Order Anytime</span>
            </div>
            <div class="about-image-placeholder">
              <span class="text-muted">FoodCourt Preview</span>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-center">
        <div
          v-for="stat in statItems"
          :key="stat.title"
          class="col-md-4 mb-3"
        >
          <h2 class="fw-bold mb-1">
            {{ stat.title }}
          </h2>
          <p class="text-muted mb-0 small">
            {{ stat.description }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.about-page {
  background-color: #fffaf6;
}

.about-check {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background-color: #ff7f50;
  color: #fff;
  font-size: 0.75rem;
}

.about-image-wrapper {
  position: relative;
  border-radius: 1rem;
  overflow: hidden;
  background: linear-gradient(135deg, #ff7f50, #ffb26b);
  height: 260px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.about-image-placeholder {
  background-color: rgba(255, 255, 255, 0.8);
  border-radius: 0.75rem;
  padding: 1.5rem 2rem;
}

.about-badge {
  position: absolute;
  top: 16px;
  left: 16px;
  background-color: #000;
  color: #fff;
  padding: 0.5rem 0.75rem;
  border-radius: 0.75rem;
  font-weight: 600;
  font-size: 0.85rem;
  text-align: center;
}
</style>
