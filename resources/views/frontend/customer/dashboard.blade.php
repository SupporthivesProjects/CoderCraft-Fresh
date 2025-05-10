@extends('frontend.layouts.app')

@if (Auth::check())
    @php
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $u2 = DB::table('last_billing_address')->where('user_id', $user_id)->orderBy('id', 'desc')->first();
        if ($u2) {
            $user = $u2;
        }
    @endphp
@endif
@section('content')
    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size"
            role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <div id="order-details-modal-body" style="background: #F6F7FB;">

                </div>
            </div>
        </div>
    </div>

    <section class="dashboard_page">
        <div class="dash_s1">
            <div class="container">
                <div class="dash_s1_content">
                    <h1 class="dash_title" id="dash_title">
                        My account
                    </h1>
                    <p class="dash_subtitle">
                        From your account Brand Sparkzboard you can vier your recent orders, manage your billing addressed and edit your password and account details.
                    </p>
                </div>
            </div>
            <img src="{{ asset('frontend/BrandSparkz/assets/img/dash_cutout.png') }}" alt="" class="img-fluid dash_cutout">
        </div>

        <div class="dash_s2">

            <div class="dash_tabpanel">


                <div class="dash_tabs_left">
                    <div class="dash_tabs_left_inner" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="btn dash_tab_btn active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M36.4701 11.5101C35.3301 6.82998 28.6699 6.82998 27.5299 11.5101C27.3597 12.2133 27.0258 12.8665 26.5555 13.4163C26.0852 13.9662 25.4917 14.3972 24.8233 14.6744C24.1549 14.9516 23.4306 15.067 22.7091 15.0114C21.9877 14.9557 21.2896 14.7305 20.6716 14.3541C16.5555 11.8461 11.8454 16.5561 14.3534 20.6722C15.9735 23.3302 14.5365 26.7983 11.5124 27.5333C6.82921 28.6703 6.82921 35.3334 11.5124 36.4674C12.2158 36.6379 12.8691 36.972 13.419 37.4427C13.9688 37.9133 14.3998 38.5072 14.6767 39.176C14.9536 39.8447 15.0686 40.5694 15.0125 41.291C14.9563 42.0126 14.7305 42.7107 14.3534 43.3286C11.8454 47.4446 16.5555 52.1547 20.6716 49.6467C21.2895 49.2696 21.9876 49.0438 22.7093 48.9876C23.4309 48.9315 24.1556 49.0465 24.8243 49.3234C25.4931 49.6003 26.0869 50.0313 26.5576 50.5811C27.0283 51.131 27.3624 51.7843 27.5329 52.4877C28.6699 57.1708 35.3331 57.1708 36.4671 52.4877C36.6381 51.7846 36.9726 51.1318 37.4434 50.5823C37.9142 50.0328 38.508 49.6022 39.1765 49.3254C39.845 49.0485 40.5694 48.9334 41.2909 48.9892C42.0123 49.045 42.7104 49.2703 43.3284 49.6467C47.4445 52.1547 52.1546 47.4446 49.6466 43.3286C49.2702 42.7106 49.0449 42.0125 48.9891 41.2911C48.9332 40.5697 49.0484 39.8453 49.3253 39.1767C49.6021 38.5082 50.0327 37.9144 50.5822 37.4437C51.1317 36.9729 51.7846 36.6384 52.4876 36.4674C57.1708 35.3304 57.1708 28.6673 52.4876 27.5333C51.7842 27.3629 51.1309 27.0287 50.5811 26.5581C50.0312 26.0874 49.6002 25.4935 49.3233 24.8248C49.0464 24.1561 48.9314 23.4314 48.9875 22.7098C49.0437 21.9882 49.2695 21.29 49.6466 20.6722C52.1546 16.5561 47.4445 11.8461 43.3284 14.3541C42.7105 14.7311 42.0124 14.957 41.2907 15.0131C40.5691 15.0693 39.8444 14.9542 39.1757 14.6773C38.5069 14.4004 37.9131 13.9695 37.4424 13.4196C36.9717 12.8698 36.6376 12.2165 36.4671 11.5131L36.4701 11.5101Z" stroke="#3C3C3C" stroke-width="2"/>
                                <path d="M37.3333 32C37.3333 34.9455 34.9455 37.3333 32 37.3333C29.0545 37.3333 26.6667 34.9455 26.6667 32C26.6667 29.0545 29.0545 26.6667 32 26.6667C34.9455 26.6667 37.3333 29.0545 37.3333 32Z" stroke="#3C3C3C" stroke-width="2"/>
                            </svg>
                            My Account
                        </button>
                        <button class="btn dash_tab_btn" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="49" height="48" viewBox="0 0 49 48" fill="none">
                                <rect x="0.5" width="48" height="48" fill="url(#pattern0_5549_8230)"/>
                                <defs>
                                <pattern id="pattern0_5549_8230" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_5549_8230" transform="scale(0.00195312)"/>
                                </pattern>
                                <image id="image0_5549_8230" width="512" height="512" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
                                </defs>
                            </svg>
                            Order History
                        </button>
                        <button class="btn dash_tab_btn" onclick="window.location.href='{{ route('logout') }}'">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="49" height="49" viewBox="0 0 49 49" fill="none">
                                <rect x="0.5" y="0.5" width="48" height="48" fill="url(#pattern0_5549_8317)"/>
                                <defs>
                                <pattern id="pattern0_5549_8317" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_5549_8317" transform="scale(0.00195312)"/>
                                </pattern>
                                <image id="image0_5549_8317" width="512" height="512" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
                                </defs>
                            </svg>
                            Sign out
                        </button>
                    </div>
                </div>

                <div class="dash_tab_cutout_center">
                    <img src="{{ asset('frontend/BrandSparkz/assets/img/dash_tab_cutout_img.png') }}" alt="" class="img-fluid mobile_none dash_tab_cutout_img">
                    <img src="{{ asset('frontend/BrandSparkz/assets/img/dash_split.png') }}" alt="" class="img-fluid desktop_none dash_tab_cutout_img_mobo">
                </div>

                <div class="dash_tabs_movable_right">

                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                            <form class="account_form" id="form-profile-update"
                                action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data"
                                onsubmit="return check_agree(this);">
                                @csrf
                                <div class="dash_account_tab_right_inner">
                                    
                                    <div class="dash_account_tab">
                                        <div class="dash_account_tab_left">
                                            <div class="dash_account_titles_div">
                                                <p class="dash_s2_titles">Personal Details</p>
                                                <div class="dash_bar"></div>
                                            </div>
                                            
                                            <div class="dash_input_container">
                                                <div class="dash_input_div">
                                                    <p class="register_input_title">First Name</p>
                                                    <input type="text" form="form-profile-update" name="name"
                                                    value="{{ Auth::user()->name }}" class="form-control input_global">
                                                </div>
                                                {{-- <div class="dash_input_div">
                                                    <p class="register_input_title">Last Name</p>
                                                    <input type="text" class="form-control input_global">
                                                </div> --}}
                                                {{-- <div class="dash_input_div">
                                                    <p class="register_input_title">Phone</p>
                                                    <input type="text" class="form-control input_global">
                                                </div> --}}
                                                <div class="dash_input_div">
                                                    <p class="register_input_title">Email</p>
                                                    <input type="email" name="email" form="form-profile-update"
                                                    value="{{ Auth::user()->email }}" class="form-control input_global">
                                                </div>
                                                <div class="dash_input_div">
                                                    <p class="register_input_title">Password</p>
                                                    <input type="password" class="form-control input_global"
                                                    form="form-profile-update" id="new_password" name="new_password">
                                                </div>
                                                <div class="dash_input_div">
                                                    <p class="register_input_title">Confirm Password</p>
                                                    <input type="password" form="form-profile-update" id="confirm_password" name="confirm_password"
                                                    required class="form-control input_global">
                                                </div>
                                                <div class="dash_input_div">
                                                    <p class="register_input_title">Country/State/Province</p>
                                                    <input type="text" class="form-control input_global" readonly
                                                        value="{{ $user->country }}" placeholder="Country/State/Province">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dash_account_tab_right">
                                            <div class="dash_account_titles_div">
                                                <p class="dash_s2_titles">Address</p>
                                                <div class="dash_bar"></div>
                                            </div>

                                            <div class="dash_input_container">
                                                <div class="dash_input_div">
                                                    <p class="register_input_title">Address Line 1</p>
                                                    <input type="text" readonly
                                                    value="{{ $user->address }}" class="form-control input_global">
                                                </div>
                                                <div class="dash_input_div">
                                                    <p class="register_input_title">Address Line 2</p>
                                                    <input type="text"  readonly
                                                    value="{{ $user->addressL2 }}" class="form-control input_global">
                                                </div>
                                                <div class="dash_input_div">
                                                    <p class="register_input_title">City</p>
                                                    <input type="text"  value="{{ $user->postal_code }}" readonly class="form-control input_global">
                                                </div>
                                                <div class="dash_input_div">
                                                    <p class="register_input_title">Country</p>
                                                    {{-- <select class="form-select input_select" aria-label="Default select example">
                                                        <option selected>Open this select menu</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select> --}}
                                                    <select class="form-select input_select " id="country-select"
                                                        aria-label="Default select example">
                                                        @foreach (\App\Models\Country::all() as $key => $country)
                                                            <option value="{{ $country->code }}"
                                                                @if ($country->code == $user->country || $country->code == $user->country) selected @endif>
                                                                {{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                <div class="dash_input_div">
                                                    <p class="register_input_title">Postcode / Zip</p>
                                                    <input type="text" value="{{ $user->postal_code }}" readonly class="form-control input_global">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn_orange_main" type="submit" form="form-profile-update">Save Changes</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                            <table class="table table-borderless order_history_table">
                                <thead>
                                    <tr class="table_ps">
                                        <th scope="col">
                                            <p class="head_ps">Order</p>
                                        </th>
                                        <th scope="col">
                                            <p class="head_ps text_center">Qty</p>
                                        </th>
                                        <th scope="col">
                                            <p class="head_ps text_center">Date</p>
                                        </th>
                                        <th scope="col">
                                            <p class="head_ps text_right">Total</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $key => $order)
                                        <tr class="table_ps">
                                            <td scope="row">
                                                <button class="btn btn_dash_pop"
                                                onclick="show_purchase_history_details({{ $order->id }})">#{{ $order->code }}</button>
                                            </td>
                                            <td>
                                                <p class="dash_tab_text">{{ $order->quantity }}</p>
                                            </td>
                                            <td>
                                                <p class="dash_tab_text text_center">{{ date('d-m-Y', $order->date) }}</p>
                                            </td>
                                            <td>
                                                <p class="dash_tab_text text_right">{{ single_price($order->grand_total) }}</p>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="no-orders-container">
                                                    <h4 class="dash_tab_text">No Orders Found</h4>
                                                    <p class="dash_tab_text">Start shopping to see your orders here!
                                                    </p>
                                                    <center>
                                                    <a href="{{route('seo')}}"
                                                        class="dash_tab_text text_center">Browse Products</a>
                                                    </center>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </section>

    
@endsection
@section('scripts')


@endsection
