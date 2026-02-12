<div class="deznav-scroll">
    <ul class="metismenu" id="menu">

        {{-- <li> --}}
            {{-- <a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false"> --}}
                {{-- <i class="flaticon-dashboard-1"></i> --}}
                {{-- <span class="nav-text">Dashboard</span> --}}
            {{-- </a>
            <ul aria-expanded="false">
                <li><a href="{{asset('/')}}"></a></li> --}}
                {{-- <li><a href="{{asset('/dashboard')}}">Dashboard</a></li> --}}
                {{-- <li><a href="{{ route('profile.index') }}">My Profile</a>
        </li> --}}
        {{-- <li><a href="{{('/analytics')}}">Analytics</a></li> --}}
        {{-- <li><a href="{{('/review')}}">Review</a></li> --}}
        {{-- <li><a href="{{('/order')}}">Order</a></li>
        <li><a href="{{('/order_list')}}">order-list</a></li>
        <li><a href="{{('/customer_list')}}">customer-list</a></li> --}}
    {{-- </ul>
    </li> --}}

    <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
            <i class="flaticon-dashboard-1"></i>
            <span class="nav-text">Menu & Category</span>
        </a>
        <ul aria-expanded="false">
            {{-- <li><a href="{{('/')}}">Dashboard</a>
    </li> --}}
    <li><a href="{{asset('/categories')}}">Categories</a></li>
    <li><a href="{{asset('/menus')}}">Menu Item</a></li>
    {{-- <li><a href="{{('/order')}}">Order</a></li>
    <li><a href="{{('/order_list')}}">order-list</a></li>
    <li><a href="{{('/customer_list')}}">customer-list</a></li> --}}
    </ul>
    </li>




    <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
            <i class="flaticon-dashboard-1"></i>
            <span class="nav-text">Customers</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{asset('/customer')}}">Add Customer</a></li>
            {{-- <li><a href="{{('/report')}}">Customer List</a>
    </li> --}}
    {{-- <li><a href="{{ route('reports.customer.items') }}">Customer Order</a></li> --}}
    </ul>
    </li>

    {{-- Restaurant Module  --}}
    <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
            <i class="flaticon-dashboard-1"></i>
            <span class="nav-text">Restaurants</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{asset('/restaurants')}}">Add Restaurant</a></li>
        </ul>
    </li>



    {{-- Store/Inventory Module  --}}
    <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
            <i class="flaticon-dashboard-1"></i>
            <span class="nav-text">Production Inventory</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{asset('/suppliers')}}">Suppliers</a></li>
            <li><a href="{{asset('/products')}}">Products</a></li>
            <li><a href="{{asset('/purchases')}}">Purchase</a></li>
            {{-- <li><a href="{{('/restaurants')}}">Stock-In</a>
    </li>
    <li><a href="{{('/restaurants')}}">Stock-Out</a></li>
    <li><a href="{{('/restaurants')}}">Stock-Adjustment</a></li> --}}
    </ul>
    </li>

    {{-- Product/Inventory Module  --}}
    <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
            <i class="flaticon-dashboard-1"></i>
            <span class="nav-text">Stocks Inventory</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{asset('/stocks')}}">Stock-Adjustment</a></li>
        </ul>
    </li>


    <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
            <i class="flaticon-dashboard-1"></i>
            <span class="nav-text">Order & Billing</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{asset('/orders')}}">Order </a></li>
            {{-- <li><a href="{{('/')}}">Order Items</a>
    </li> --}}
    {{-- <li><a href="{{ ('orders') }}">Payment System</a></li> --}}

    </ul>
    </li>



    {{-- <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
    <i class="flaticon-dashboard-1"></i>
    <span class="nav-text">Reports & Analytics</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{asset('/customer')}}">Daily Sales Report</a></li>
        <li><a href="{{asset('/report')}}">Monthly Sales Report</a></li>
        <li><a href="{{asset('/report')}}">Best Selling Items</a></li>
    </ul>
    </li> --}}


    <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
            <i class="flaticon-dashboard-1"></i>
            <span class="nav-text">Reports</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{ route('orders.reports.delivered') }}">Delivered Invoices</a></li>
            {{-- <li><a href="{{ route('reports.customer.items') }}">Customer Order</a></li> --}}
        </ul>
    </li>


    <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
            <i class="flaticon-landing-page"></i>
            <span class="nav-text">Pages</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{ route('register') }}">Register</a></li>
            @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            @endguest

            @auth
            <li><a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Login
                </a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endauth



            {{-- <li><a class="has-arrow" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">Error</a>
                <ul aria-expanded="false">
                    <li><a href="{{asset('assets')}}/page-error-400.html">Error 400</a></li>
                    <li><a href="{{asset('assets')}}/page-error-403.html">Error 403</a></li>
                    <li><a href="{{asset('assets')}}/page-error-404.html">Error 404</a></li>
                    <li><a href="{{asset('assets')}}/page-error-500.html">Error 500</a></li>
                    <li><a href="{{asset('assets')}}/page-error-503.html">Error 503</a></li>
                </ul>
            </li>
            <li><a href="{{asset('assets')}}/page-lock-screen.html">Lock Screen</a></li> --}}
        </ul>
    </li>


    {{-- <li><a class="has-arrow ai-icon"
                        href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
    <i class="flaticon-app"></i>
    <span class="nav-text">Apps</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{('/Profile')}}">Profile</a></li>
        <li><a href="{{('/post_details')}}">Post Details</a></li>
        <li><a class="has-arrow" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">Email</a>
            <ul aria-expanded="false">
                <li><a href="{{('/composer')}}">Composer</a></li>
                <li><a href="{{('/inbox')}}">Inbox</a></li>
                <li><a href="{{('/read')}}">Read</a></li>
                {{-- <li><a href="{{asset('assets')}}/email-read.html"></a>
        </li> --}}
        {{-- </ul>
                            </li> --}}


        {{-- <li><a href="{{('/calender')}}">Calender</a></li>
        <li><a class="has-arrow" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">Shop</a>
            <ul aria-expanded="false">
                <li><a href="{{('/Product_Gird')}}/">Product Grid</a></li>
                <li><a href="{{asset('assets')}}/ecom-product-list.html">Product List</a></li>
                <li><a href="{{asset('assets')}}/ecom-product-detail.html">Product Details</a></li>
                <li><a href="{{asset('assets')}}/ecom-product-order.html">Order</a></li>
                <li><a href="{{asset('assets')}}/ecom-checkout.html">Checkout</a></li>
                <li><a href="{{asset('assets')}}/ecom-invoice.html">Invoice</a></li>
                <li><a href="{{asset('assets')}}/ecom-customers.html">Customers</a></li>
            </ul>
        </li>
    </ul>
    </li> --}}

    {{-- <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
    <i class="flaticon-bar-chart-1"></i>
    <span class="nav-text">Charts</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{asset('assets')}}/chart-flot.html">Flot</a></li>
        <li><a href="{{asset('assets')}}/chart-morris.html">Morris</a></li>
        <li><a href="{{asset('assets')}}/chart-chartjs.html">Chartjs</a></li>
        <li><a href="{{asset('assets')}}/chart-chartist.html">Chartist</a></li>
        <li><a href="{{asset('assets')}}/chart-sparkline.html">Sparkline</a></li>
        <li><a href="{{asset('assets')}}/chart-peity.html">Peity</a></li>
    </ul>
    </li> --}}

    {{-- <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
    <i class="flaticon-star"></i>
    <span class="nav-text">Bootstrap</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{asset('assets')}}/ui-accordion.html">Accordion</a></li>
        <li><a href="{{asset('assets')}}/ui-alert.html">Alert</a></li>
        <li><a href="{{asset('assets')}}/ui-badge.html">Badge</a></li>
        <li><a href="{{asset('assets')}}/ui-button.html">Button</a></li>
        <li><a href="{{asset('assets')}}/ui-modal.html">Modal</a></li>
        <li><a href="{{asset('assets')}}/ui-button-group.html">Button Group</a></li>
        <li><a href="{{asset('assets')}}/ui-list-group.html">List Group</a></li>
        <li><a href="{{asset('assets')}}/ui-media-object.html">Media Object</a></li>
        <li><a href="{{asset('assets')}}/ui-card.html">Cards</a></li>
        <li><a href="{{asset('assets')}}/ui-carousel.html">Carousel</a></li>
        <li><a href="{{asset('assets')}}/ui-dropdown.html">Dropdown</a></li>
        <li><a href="{{asset('assets')}}/ui-popover.html">Popover</a></li>
        <li><a href="{{asset('assets')}}/ui-progressbar.html">Progressbar</a></li>
        <li><a href="{{asset('assets')}}/ui-tab.html">Tab</a></li>
        <li><a href="{{asset('assets')}}/ui-typography.html">Typography</a></li>
        <li><a href="{{asset('assets')}}/ui-pagination.html">Pagination</a></li>
        <li><a href="{{asset('assets')}}/ui-grid.html">Grid</a></li>

    </ul>
    </li> --}}

    {{-- <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
    <i class="flaticon-plugin"></i>
    <span class="nav-text">Plugins</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{asset('assets')}}/uc-select2.html">Select 2</a></li>
        <li><a href="{{asset('assets')}}/uc-nestable.html">Nestedable</a></li>
        <li><a href="{{asset('assets')}}/uc-noui-slider.html">Noui Slider</a></li>
        <li><a href="{{asset('assets')}}/uc-sweetalert.html">Sweet Alert</a></li>
        <li><a href="{{asset('assets')}}/uc-toastr.html">Toastr</a></li>
        <li><a href="{{asset('assets')}}/map-jqvmap.html">Jqv Map</a></li>
        <li><a href="{{asset('assets')}}/uc-lightgallery.html">Light Gallery</a></li>
    </ul>
    </li> --}}

    {{-- <li><a href="{{asset('assets')}}/widget-basic.html" class="ai-icon" aria-expanded="false">
    <i class="flaticon-network"></i>
    <span class="nav-text">Widget</span>
    </a>
    </li> --}}

    {{-- <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
    <i class="flaticon-email"></i>
    <span class="nav-text">Icons</span>
    <span class="badge badge-sm badge-danger ms-3">New</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{asset('assets')}}/flat-icons.html">Flaticons</a></li>
        <li><a href="{{asset('assets')}}/svg-icons.html">SVG Icons</a></li>

    </ul>
    </li> --}}

    {{-- <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
    <i class="flaticon-form"></i>
    <span class="nav-text">Forms</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{asset('assets')}}/form-element.html">Form Elements</a></li>
        <li><a href="{{asset('assets')}}/form-wizard.html">Wizard</a></li>
        <li><a href="{{asset('assets')}}/form-ckeditor.html">CkEditor</a></li>
        <li><a href="{{asset('assets')}}/form-pickers.html">Pickers</a></li>
        <li><a href="{{asset('assets')}}/form-validation-jquery.html">Jquery Validate</a></li>
    </ul>
    </li> --}}

    {{-- <li><a class="has-arrow ai-icon" href="{{asset('assets')}}/javascript:void()" aria-expanded="false">
    <i class="flaticon-table"></i>
    <span class="nav-text">Table</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{asset('assets')}}/table-bootstrap-basic.html">Bootstrap</a></li>
        <li><a href="{{asset('assets')}}/table-datatable-basic.html">Datatable</a></li>
    </ul>
    </li> --}}


    </ul>
    <br>
    {{-- <div class="plus-box">
					<p class="fs-13 font-w300 mb-4">Organize your menus through button bellow</p>
					<a class="btn bg-white text-black btn-rounded d-block" href="{{asset('assets')}}/javascript:;">+Add Menus</a>
</div> --}}
<div class="copyright">
    <p class="fs-14 font-w200"><strong class="font-w400">Abir's FoodCourt Restaurant Admin Dashboard</strong> © 2026 All Rights Reserved</p>
    <p>Made with <span class="heart"></span> by Mahedi Hasan</p>
</div>
</div>
