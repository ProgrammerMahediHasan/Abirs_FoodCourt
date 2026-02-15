@extends('layout.erp.app')
@section('dashboard')
Welcome to Abir's FoodCourt
@endsection
@section('content')

	<!--**********************************
            Content body start
        ***********************************-->

            <!-- row -->
			<div class="container-fluid" style="background-color: #f8f9fa;">
    <div class="form-head d-flex mb-3 mb-lg-5 align-items-start">
        <div class="me-auto d-none d-lg-block">
            {{-- <a class="text-primary d-flex align-items-center mb-3 font-w500" href="{{asset('assets')}}/index.html"> --}}
                <svg class="me-3" width="24" height="12" viewBox="0 0 24 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.274969 5.14888C0.27525 5.1486 0.275484 5.14827 0.275812 5.14799L5.17444 0.272997C5.54142 -0.0922061 6.135 -0.090847 6.5003 0.276184C6.86555 0.643168 6.86414 1.23675 6.49716 1.60199L3.20822 4.87499H23.0625C23.5803 4.87499 24 5.29471 24 5.81249C24 6.33027 23.5803 6.74999 23.0625 6.74999H3.20827L6.49711 10.023C6.86409 10.3882 6.8655 10.9818 6.50025 11.3488C6.13495 11.7159 5.54133 11.7171 5.17439 11.352L0.275764 6.47699C0.275483 6.47671 0.27525 6.47638 0.274921 6.4761C-0.0922505 6.10963 -0.0910778 5.51413 0.274969 5.14888Z" fill="#EA4989"/>
                </svg>
                Back
            </a>
            <a class="mb-0 text-secondary fs-18 font-w500" href="{{asset('assets')}}/#">Review  /</a>
            <a class="mb-0 font-w500 fs-18" href="{{asset('assets')}}/#"> Customer Review </a>
        </div>
        <a href="{{asset('assets')}}/javascript:void(0);" class="btn btn-success ms-auto btn-rounded d-md-flex align-items-center d-inline-block">
            <!-- PUBLISH SVG ICON -->
            PUBLISH
        </a>
        <a href="{{asset('assets')}}/javascript:void(0);" class="btn btn-danger ms-3 btn-rounded d-md-flex align-items-center d-inline-block">
            <!-- DELETE SVG ICON -->
            DELETE
        </a>
        <div class="input-group search-area ms-3 d-inline-flex">
            <input type="text" class="form-control" placeholder="Search here">
            <div class="input-group-append">
                <a href="{{asset('assets')}}/javascript:void" class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></a>
            </div>
        </div>
        <div class="dropdown ms-3 d-inline-block">
            <div class="btn btn-outline-primary btn-rounded dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <!-- Filter SVG ICON -->
                Filter
            </div>
            <div class="dropdown-menu dropdown-menu-left">
                <a class="dropdown-item" href="{{asset('assets')}}/#">A To Z List</a>
                <a class="dropdown-item" href="{{asset('assets')}}/#">Z To A List</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card review-table p-0 border-0">
                <!-- REVIEW ITEM 1 -->
                <div class="row align-items-center p-4 border-bottom">
                    <div class="col-xl-4 col-xxl-4 col-lg-5 col-md-12">
                        <div class="media align-items-center">
                            <div class="form-check custom-checkbox me-4">
                                <input type="checkbox" class="form-check-input" id="gridCheck">
                                <label class="form-check-label form-label" for="gridCheck"></label>
                            </div>
                            <img class="me-3 img-fluid rounded-circle" width="100" src="{{asset('assets')}}/images/profile/5.jpg" alt="DexignZone">
                            <div class="card-body p-0">
                                <p class="text-primary fs-14 mb-0">#C01234</p>
                                <h3 class="fs-20 text-black font-w600 mb-2">James Sitepu</h3>
                                <span class="text-dark">26/04/2020, 12:42 AM</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-4 col-lg-7 col-md-12 mt-3 mt-lg-0">
                        <p class="mb-0 text-dark">We recently had dinner with friends at David CC and we all walked away with a great experience...</p>
                    </div>
                    <div class="col-xl-3 col-xxl-4 col-lg-7 col-md-12 offset-lg-5 offset-xl-0 media-footer mt-xl-0 mt-3">
                        <div class="row">
                            <div class="text-xl-center col-xl-7 col-sm-9 col-lg-8 col-6">
                                <h2 class="text-black font-w600">4.5</h2>
                                <span class="star-review d-inline-block">
                                    <i class="fas fa-star text-orange"></i>
                                    <i class="fas fa-star text-orange"></i>
                                    <i class="fas fa-star text-orange"></i>
                                    <i class="fas fa-star text-orange"></i>
                                    <i class="fas fa-star text-gray"></i>
                                </span>
                            </div>
                            <div class="edit ms-auto col-xl-5 col-sm-3 col-lg-4 col-6">
                                <!-- Action Icons -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- REVIEW ITEM 2 -->
                <div class="row align-items-center p-4 border-bottom">
                    <div class="col-xl-4 col-xxl-4 col-lg-5 col-md-12">
                        <div class="media align-items-center">
                            <div class="form-check custom-checkbox me-4">
                                <input type="checkbox" class="form-check-input" id="gridCheck1">
                                <label class="form-check-label form-label" for="gridCheck1"></label>
                            </div>
                            <img class="me-3 img-fluid rounded-circle" width="100" src="{{asset('assets')}}/images/profile/6.jpg" alt="DexignZone">
                            <div class="card-body p-0">
                                <p class="text-primary fs-14 mb-0">#C01234</p>
                                <h3 class="fs-20 text-black font-w600 mb-2">Angela Moss</h3>
                                <span class="text-dark">26/04/2020, 12:42 AM</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-4 col-lg-7 col-md-12 mt-3 mt-lg-0">
                        <p class="mb-0 text-dark">We recently had dinner with friends at David CC and we all walked away with a great experience...</p>
                    </div>
                    <div class="col-xl-3 col-xxl-4 col-lg-7 col-md-12 offset-lg-5 offset-xl-0 media-footer mt-xl-0 mt-3">
                        <div class="row">
                            <div class="text-xl-center col-xl-7 col-sm-9 col-lg-8 col-6">
                                <h2 class="text-black font-w600">4.2</h2>
                                <span class="star-review d-inline-block">
                                    <i class="fas fa-star text-orange"></i>
                                    <i class="fas fa-star text-orange"></i>
                                    <i class="fas fa-star text-orange"></i>
                                    <i class="fas fa-star text-orange"></i>
                                    <i class="fas fa-star text-gray"></i>
                                </span>
                            </div>
                            <div class="edit ms-auto col-xl-5 col-sm-3 col-lg-4 col-6">
                                <!-- Action Icons -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add more review items here as needed -->

            </div>
        </div>
    </div>
</div>



@endsection
