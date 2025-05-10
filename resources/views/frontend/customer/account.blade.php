@extends('frontend.layouts.app')
<style>

</style>
@section('content')
    
    <section class="dashboard-page pb-4 mb-n2">
        <img src="{{ asset('frontend/dist/img/dashboard-bg.png') }}" alt="trems-bg-img" class="img-fluid bg-image">
        <div class="account-bg mt-7 my-4">
            <div class="container">
                <h2 class="account-head-mo d-block d-lg-none d-md-none">Dashboard</h2>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 account-menu-collec ">
                        <div class="all-btn-account d-flex justify-content-lg-around">
                            <a href="{{ route('dashboard') }}" class="account-menu   mr-3">My Account</a>
                            <a href="{{ route('purchase_history.index') }}" class="account-menu mr-3">My Orders</a>
                            <a href="{{ route('addresses') }}" class=" account-menu mr-3">Addresses</a>
                            <a href="{{ route('account') }}" class="account-menu active mr-3">Account details</a>
                            <a href="{{ route('logout') }}" class="account-menu ">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-12 m-auto">
                    <div class="account-content text-center">
                        <h2 class="account-head mt-lg-2 mt-4 text-left text-lg-center">Account details</h2>
                        <p class="para-white text-left text-lg-center d-none d-lg-block d-md-block">
                            From your account dashboard you can view your recent orders,
                            manage your <br>shipping and billing addresses, and edit your
                            password and account details.
                        </p>
                        <p class="para-white text-left text-lg-center d-block d-lg-none d-md-none">
                            From your account dashboard you can view your recent orders, manage your
                            shipping and billing addresses, and edit your password and account details.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
                    <div class="account-box m-auto py-4">
                        <div class="login-content">
                            <h2 class="account-sub-head text-left text-lg-center">Edit Your Account Details</h2>
                            <p class="para-white mb-4 text-left text-lg-center">Click in the forms to edit any of the below
                                information</p>
                        </div>
                        <form class="form-default form-group" id="account" action="{{ route('customer.profile.update') }}"
                            method="POST">
                            @csrf
                            <div class="row px-lg-7">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <input type="type" class="form-control-lg" name="name" id="name"
                                        value="{{ Auth::user()->name }}" placeholder="Full Name" required />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <input type="email" class="form-control-lg" name="email"
                                        value="{{ Auth::user()->email }}" placeholder="Email" readonly />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <input type="password" placeholder="Current Password" name="new_password"
                                        id="new_password" class="form-control-lg" required />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        class="form-control-lg" placeholder="New Password" required />
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                    <button class="btn btn-green w-100" type="submit"> save change </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
@endsection
