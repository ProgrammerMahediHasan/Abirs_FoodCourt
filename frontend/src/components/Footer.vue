<template>
  <footer class="app-footer">
    <div class="footer-overlay pt-5 pb-3">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-xxl-4 col-lg-4 col-sm-9 col-md-7 mb-4">
            <div class="footer-block">
              <div class="footer-logo mb-3 d-flex align-items-center">
                <!-- <img
                  src="http://localhost/Abirs_FoodCourt/public/assets/images/logo.svg"
                  alt="Abir's FoodCourt"
                  class="footer-logo-img me-2"
                /> -->
                <span class="footer-logo-text">Abir's FoodCourt</span>
              </div>
              <p class="footer-text mb-3">
                A modern online foodcourt experience where you can browse categories, add items to
                your cart, and confirm your order in a few simple steps.
              </p>

              <div class="d-flex flex-wrap footer-social">

                <a
                  href="#"
                  class="footer-social-link"
                >
                  Facebook
                </a>

                <a
                  href="#"
                  class="footer-social-link"
                >
                  Youtube
                </a>

                <a
                  href="#"
                  class="footer-social-link"
                >
                  Twitter
                </a>

                <a
                  href="#"
                  class="footer-social-link"
                >
                  Instagram
                </a>

              </div>
            </div>
          </div>

          <div class="col-xxl-2 col-lg-2 col-sm-5 col-md-5 mb-4">
            <div class="footer-block">
              <h5 class="footer-title">Short Links</h5>
              <ul class="footer-list">
                <li>
                  <a href="/">Home</a>
                </li>
                <li>
                  <a href="/about">About Us</a>
                </li>
                <li>
                  <a href="/products">Products</a>
                </li>
                <li>
                  <a href="/contact">Contact Us</a>
                </li>
                <li>
                  <a href="/dashboard">Dashboard</a>
                </li>
              </ul>
            </div>
          </div>

          <div class="col-xxl-2 col-lg-2 col-sm-6 col-md-5 mb-4">
            <div class="footer-block">
              <h5 class="footer-title">Help Links</h5>
              <ul class="footer-list">
                <li>
                  <a href="/blogs">Our Blogs</a>
                </li>
                <li>
                  <a href="/pages">FAQ</a>
                </li>
                <li>
                  <a href="#">Privacy Policy</a>
                </li>
                <li>
                  <a href="#">Terms &amp; Conditions</a>
                </li>
              </ul>
            </div>
          </div>

          <div class="col-xxl-3 col-lg-4 col-sm-9 col-md-7 mb-4">
            <div class="footer-block">
              <h5 class="footer-title">Contact Us</h5>
              <p class="footer-info">
                <span class="footer-info-label">Call:</span>
                <span class="footer-info-value">+880 1632606827</span>
              </p>
              <p class="footer-info">
                <span class="footer-info-label">Email:</span>
                <span class="footer-info-value">abirsfoodcourt@gmail.com</span>
              </p>
              <p class="footer-info">
                <span class="footer-info-label">Address:</span>
                <span class="footer-info-value">Narayanganj, Dhaka, Bangladesh</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <p class="mb-0 text-center footer-bottom-text">
          © Abir's FoodCourt {{ new Date().getFullYear() }}. All rights reserved.
        </p>
      </div>
    </div>
  </footer>
</template>

<style scoped>
.app-footer {
  color: #fff;
  background: radial-gradient(circle at top left, #ff7f50 0, #1b1b1b 45%, #000 100%);
}

.footer-overlay {
  background: rgba(0, 0, 0, 0.85);
}

.footer-block {
  color: #f5f5f5;
}

.footer-logo-img {
  height: 36px;
  width: auto;
}

.footer-logo-text {
  font-weight: 600;
  font-size: 1.1rem;
}

.footer-text {
  font-size: 0.9rem;
}

.footer-social-link {
  font-size: 0.85rem;
  color: #ffffff;
  margin-right: 0.75rem;
  text-decoration: none;
}

.footer-social-link:hover {
  text-decoration: underline;
}

.footer-title {
  font-size: 1rem;
  margin-bottom: 0.75rem;
}

.footer-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-list li {
  margin-bottom: 0.35rem;
}

.footer-list a {
  color: #f5f5f5;
  font-size: 0.9rem;
  text-decoration: none;
}

.footer-list a:hover {
  text-decoration: underline;
}

.footer-info {
  font-size: 0.9rem;
  margin-bottom: 0.35rem;
}

.footer-info-label {
  font-weight: 600;
  margin-right: 0.25rem;
}

.footer-bottom {
  background: rgba(0, 0, 0, 0.9);
  padding: 0.75rem 0;
}

.footer-bottom-text {
  font-size: 0.8rem;
  color: #cccccc;
}
</style>
