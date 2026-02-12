@extends('layout.erp.app')

@section('title', $supplier->name . ' | Supplier Details')

@section('content')

<style>
    :root {
        --coral: #FF6B6B;
        --coral-light: #FF8E8E;
        --coral-bg: #FFF5F5;
        --coral-border: #FFE5E5;
        --coral-shadow: rgba(255, 107, 107, 0.1);
    }

    .supplier-page {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 20px 0;
    }

    .supplier-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Animated Header */
    .header-card {
        background: linear-gradient(135deg, var(--coral) 0%, var(--coral-light) 100%);
        color: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(255, 107, 107, 0.25);
        position: relative;
        overflow: hidden;
        animation: fadeInDown 0.6s ease-out;
    }

    .header-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.3;
        animation: floatBackground 20s linear infinite;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes floatBackground {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    /* Avatar with Glow Effect */
    .supplier-avatar {
        width: 80px;
        height: 80px;
        background: white;
        color: var(--coral);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        box-shadow: 0 10px 25px rgba(255, 107, 107, 0.3);
        position: relative;
        transition: all 0.3s ease;
    }

    .supplier-avatar:hover {
        transform: scale(1.1);
        box-shadow: 0 15px 35px rgba(255, 107, 107, 0.4);
    }

    .supplier-avatar::after {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        background: linear-gradient(135deg, var(--coral) 0%, var(--coral-light) 100%);
        border-radius: 50%;
        z-index: -1;
        opacity: 0.2;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 0.2; }
        50% { opacity: 0.4; }
    }

    /* Info Cards with Hover Effects */
    .info-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        border: 1px solid var(--coral-border);
        box-shadow: 0 5px 15px var(--coral-shadow);
        transition: all 0.3s ease;
        animation: slideUp 0.5s ease-out;
        animation-fill-mode: both;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(255, 107, 107, 0.15);
        border-color: var(--coral-light);
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Card Title with Gradient */
    .card-title {
        color: var(--coral);
        font-weight: 600;
        border-bottom: 2px solid var(--coral-border);
        padding-bottom: 0.5rem;
        margin-bottom: 1.2rem;
        position: relative;
        display: inline-block;
    }

    .card-title::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, var(--coral), var(--coral-light));
    }

    /* Detail Items with Interactive Design */
    .detail-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.8rem;
        border-radius: 10px;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .detail-item:hover {
        background: var(--coral-bg);
        transform: translateX(5px);
    }

    .detail-item:last-child {
        margin-bottom: 0;
    }

    .detail-icon {
        width: 36px;
        height: 36px;
        background: var(--coral-bg);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--coral);
        transition: all 0.3s ease;
    }

    .detail-item:hover .detail-icon {
        background: var(--coral);
        color: white;
        transform: scale(1.1);
    }

    .detail-label {
        font-size: 12px;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .detail-value {
        font-weight: 500;
        color: #333;
    }

    /* Balance Box with Shimmer Effect */
    .balance-box {
        color: white;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .balance-box::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            to bottom right,
            rgba(255,255,255,0) 0%,
            rgba(255,255,255,0.1) 50%,
            rgba(255,255,255,0) 100%
        );
        transform: rotate(30deg);
        animation: shimmer 3s infinite linear;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%) rotate(30deg); }
        100% { transform: translateX(100%) rotate(30deg); }
    }

    .balance-positive {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
    }

    .balance-negative {
        background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
    }

    /* Action Grid with Modern Buttons */
    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
    }

    .action-btn {
        background: white;
        border-radius: 12px;
        border: 1px solid var(--coral-border);
        padding: 1.2rem;
        text-align: center;
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 107, 107, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .action-btn:hover::before {
        left: 100%;
    }

    .action-btn:hover {
        transform: translateY(-4px);
        color: var(--coral);
        box-shadow: 0 15px 30px rgba(255, 107, 107, 0.2);
        border-color: var(--coral-light);
    }

    .action-btn i {
        font-size: 24px;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }

    .action-btn:hover i {
        transform: scale(1.2);
    }

    /* Back Button with Animation */
    .back-btn {
        color: var(--coral);
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
        background: white;
        border: 1px solid var(--coral-border);
    }

    .back-btn:hover {
        background: var(--coral-bg);
        transform: translateX(-5px);
        color: var(--coral-light);
    }

    /* Badge Styles */
    .status-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 12px;
        font-weight: 500;
    }

    /* Animation Delays */
    .info-card:nth-child(2) { animation-delay: 0.1s; }
    .info-card:nth-child(3) { animation-delay: 0.2s; }
    .info-card:nth-child(4) { animation-delay: 0.3s; }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header-card {
            padding: 1.5rem;
            text-align: center;
        }

        .supplier-avatar {
            margin: 0 auto 1rem;
        }

        .action-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .action-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="supplier-page">
    <div class="supplier-container">
        <!-- Back Button -->
        <a href="{{ route('suppliers.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Suppliers
        </a>

        <!-- Header Card -->
        <div class="header-card">
            <div class="row align-items-center">
                <div class="col-md-2 text-center text-md-start">
                    <div class="supplier-avatar">
                        <i class="fas fa-store"></i>
                    </div>
                </div>
                <div class="col-md-8 text-center text-md-start">
                    <h3 class="fw-bold mb-1">{{ $supplier->name }}</h3>
                    @if($supplier->company_name)
                    <p class="mb-2 opacity-75">{{ $supplier->company_name }}</p>
                    @endif
                    <div class="d-flex gap-2 justify-content-center justify-content-md-start">
                        <span class="status-badge">
                            <i class="fas fa-circle {{ $supplier->is_active ? 'text-success' : 'text-danger' }} me-1"></i>
                            {{ $supplier->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <span class="status-badge">
                            <i class="fas fa-tag me-1"></i>
                            {{ ucfirst($supplier->supplier_type) }}
                        </span>
                    </div>
                </div>
                <div class="col-md-2 text-center text-md-end">
                    <small class="opacity-75">ID: #{{ str_pad($supplier->id, 4, '0', STR_PAD_LEFT) }}</small>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="info-card">
            <h5 class="card-title"><i class="fas fa-address-card me-2"></i>Contact Information</h5>

            <div class="detail-item" onclick="window.location='tel:{{ $supplier->phone }}'">
                <div class="detail-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <div>
                    <div class="detail-label">Phone Number</div>
                    <div class="detail-value">{{ $supplier->phone }}</div>
                </div>
                <div class="ms-auto">
                    <i class="fas fa-external-link-alt text-muted"></i>
                </div>
            </div>

            @if($supplier->email)
            <div class="detail-item" onclick="window.location='mailto:{{ $supplier->email }}'">
                <div class="detail-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <div class="detail-label">Email Address</div>
                    <div class="detail-value">{{ $supplier->email }}</div>
                </div>
                <div class="ms-auto">
                    <i class="fas fa-external-link-alt text-muted"></i>
                </div>
            </div>
            @endif

            @if($supplier->address)
            <div class="detail-item" onclick="copyToClipboard('{{ $supplier->address }}')">
                <div class="detail-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <div class="detail-label">Address</div>
                    <div class="detail-value">{{ $supplier->address }}</div>
                </div>
                <div class="ms-auto">
                    <i class="fas fa-copy text-muted"></i>
                </div>
            </div>
            @endif
        </div>

        <!-- Financial Information -->
        <div class="info-card">
            <h5 class="card-title"><i class="fas fa-chart-line me-2"></i>Financial Information</h5>

            <div class="balance-box {{ $supplier->balance >= 0 ? 'balance-positive' : 'balance-negative' }}">
                <small class="opacity-75">CURRENT BALANCE</small>
                <h2 class="fw-bold mb-2">৳ {{ number_format($supplier->balance, 2) }}</h2>
                <small>{{ $supplier->balance >= 0 ? 'Positive Balance' : 'Negative Balance' }}</small>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div>
                            <div class="detail-label">Payment Terms</div>
                            <div class="detail-value">{{ $supplier->payment_terms }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <div class="detail-label">Member Since</div>
                            <div class="detail-value">{{ $supplier->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-icon">
                    <i class="fas fa-history"></i>
                </div>
                <div>
                    <div class="detail-label">Last Updated</div>
                    <div class="detail-value">{{ $supplier->updated_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="info-card">
            <h5 class="card-title"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>

            <div class="action-grid">
                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="action-btn">
                    <i class="fas fa-edit"></i>
                    <span>Edit Supplier</span>
                </a>

                <a href="tel:{{ $supplier->phone }}" class="action-btn">
                    <i class="fas fa-phone"></i>
                    <span>Call Now</span>
                </a>

                @if($supplier->email)
                <a href="mailto:{{ $supplier->email }}" class="action-btn">
                    <i class="fas fa-envelope"></i>
                    <span>Send Email</span>
                </a>
                @endif

                <a href="{{ route('purchases.create', ['supplier_id' => $supplier->id]) }}" class="action-btn">
                    <i class="fas fa-cart-plus"></i>
                    <span>New Purchase</span>
                </a>

<form method="POST" action="{{ route('suppliers.destroy', $supplier->id) }}">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure you want to delete this supplier and all related products & purchases?')"
            class="action-btn">
        <i class="fas fa-trash text-danger"></i>
        <span>Delete Supplier</span>
    </button>
</form>

            </div>
        </div>
    </div>
</div>

<script>
    // Interactive Functions
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            showToast('Address copied to clipboard!', 'success');
        });
    }

    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} position-fixed top-0 end-0 m-3`;
        toast.style.zIndex = '9999';
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(toast);

        setTimeout(() => toast.remove(), 3000);
    }

    // Add click animation to all detail items
    document.querySelectorAll('.detail-item').forEach(item => {
        item.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });

    // Add page load animation
    document.addEventListener('DOMContentLoaded', function() {
        document.body.style.opacity = '0';
        document.body.style.transition = 'opacity 0.5s ease';

        setTimeout(() => {
            document.body.style.opacity = '1';
        }, 100);
    });

    // Balance animation
    const balanceBox = document.querySelector('.balance-box');
    if (balanceBox) {
        balanceBox.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
        });

        balanceBox.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    }
</script>
@endsection
