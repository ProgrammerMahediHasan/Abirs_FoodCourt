@extends('layout.erp.app')
@section('title', 'My Profile')
@section('dashboard', 'Profile')

@section('content')
<style>
    /* Profile Specific Styles */
    .profile-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: none;
    }

    .profile-header-cover {
        background: linear-gradient(135deg, #FF7F50 0%, #FF6347 100%);
        height: 150px;
        position: relative;
    }

    .profile-avatar-container {
        position: absolute;
        bottom: -50px;
        left: 50px;
        border: 5px solid white;
        border-radius: 50%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        background: white;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
    }

    .profile-info-section {
        padding-top: 60px;
        padding-left: 50px;
        padding-right: 50px;
        padding-bottom: 30px;
    }

    .profile-name {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 28px;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .profile-role {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        color: #FF7F50;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .profile-meta {
        margin-top: 20px;
        display: flex;
        gap: 20px;
        color: #95a5a6;
        font-size: 14px;
    }

    .profile-meta i {
        color: #FF7F50;
        margin-right: 5px;
    }

    .profile-tabs .nav-link {
        color: #95a5a6;
        font-weight: 500;
        padding: 15px 25px;
        border: none;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .profile-tabs .nav-link.active {
        color: #FF7F50;
        border-bottom: 3px solid #FF7F50;
        background: transparent;
    }

    .profile-tabs .nav-link:hover {
        color: #FF7F50;
    }

    .info-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .info-value {
        color: #7f8c8d;
        font-size: 15px;
    }

    .edit-btn {
        background: rgba(255, 127, 80, 0.1);
        color: #FF7F50;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .edit-btn:hover {
        background: #FF7F50;
        color: white;
    }

    @media (max-width: 768px) {
        .profile-avatar-container {
            left: 50%;
            transform: translateX(-50%);
        }

        .profile-info-section {
            text-align: center;
            padding-left: 20px;
            padding-right: 20px;
        }

        .profile-meta {
            justify-content: center;
            flex-wrap: wrap;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="profile-card mb-4">
                <div class="profile-header-cover">
                    <div class="profile-avatar-container">
                        <!-- User Profile Image -->
                        <img src="{{ asset('assets\images\Abir.jpg') }}" class="profile-avatar" alt="Profile Picture">
                    </div>
                </div>
                <div class="profile-info-section">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="profile-name">{{ $user->name }}</h2>
                            <p class="profile-role">Administrator</p> <!-- Dynamic Role if available -->

                            <div class="profile-meta">
                                <span><i class="fas fa-envelope"></i> {{ $user->email }}</span>
                                <span><i class="fas fa-map-marker-alt"></i> Dhaka, Bangladesh</span>
                                <span><i class="fas fa-calendar-alt"></i> Joined {{ $user->created_at->format('F Y') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <button class="edit-btn" onclick="document.querySelector('a[href=\'#settings\']').click()">
                                <i class="fas fa-edit me-2"></i> Edit Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
            <div class="card" style="border-radius: 20px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                <div class="card-header border-0 pb-0 bg-white pt-4 px-4">
                    <h5 class="text-black font-w600">Personal Information</h5>
                </div>
                <div class="card-body pt-3">
                    <div class="mb-3">
                        <p class="info-label">Full Name</p>
                        <p class="info-value">{{ $user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="info-label">Email Address</p>
                        <p class="info-value">{{ $user->email }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="info-label">Phone</p>
                        <p class="info-value">+880 1712 345678</p>
                    </div>
                    <div class="mb-3">
                        <p class="info-label">Location</p>
                        <p class="info-value">Dhaka, Bangladesh</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card" style="border-radius: 20px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                <div class="card-header border-0 bg-white">
                    <ul class="nav nav-tabs profile-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#about" data-bs-toggle="tab">About Me</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#settings" data-bs-toggle="tab">Settings</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="about">
                            <h5 class="text-primary mb-3" style="color: #FF7F50 !important;">Biography</h5>
                            <p class="mb-4 text-muted" style="line-height: 1.6;">
                                Hello! I am {{ $user->name }}, a passionate administrator for Abir's FoodCourt.
                                I love managing restaurant operations and ensuring everything runs smoothly.
                                With a keen eye for detail and a dedication to customer satisfaction, I strive to provide the best experience for our patrons.
                            </p>

                            <h5 class="text-primary mb-3" style="color: #FF7F50 !important;">Skills & Expertise</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-light text-dark p-2">Restaurant Management</span>
                                <span class="badge bg-light text-dark p-2">Customer Service</span>
                                <span class="badge bg-light text-dark p-2">Inventory Control</span>
                                <span class="badge bg-light text-dark p-2">Staff Training</span>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="settings">
                            <form>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">First Name</label>
                                        <input type="text" placeholder="John" class="form-control" value="{{ explode(' ', $user->name)[0] }}">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" placeholder="Doe" class="form-control" value="{{ isset(explode(' ', $user->name)[1]) ? explode(' ', $user->name)[1] : '' }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" placeholder="Email" class="form-control" value="{{ $user->email }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" placeholder="New Password" class="form-control">
                                </div>
                                <button class="btn btn-primary" type="button" style="background-color: #FF7F50; border-color: #FF7F50;">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
