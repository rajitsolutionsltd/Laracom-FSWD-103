@extends('frontEnd.layouts.masters')

@section('content')
    <div class="ltn__login-area pb-65" style="padding-top:120px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center">
                        <h1 class="section-title">Sign In <br>To Your Account</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="account-login-inner">
                        <form action="{{ route('customer.login') }}" class="ltn__form-box contact-form-box" method="post">
                            @csrf
                            <input type="text" name="email" placeholder="Email*" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input type="password" name="password" placeholder="Password*">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="btn-wrapper mt-0">
                                <button class="theme-btn-1 btn btn-block" type="submit">SIGN IN</button>
                            </div>
                            <div class="go-to-btn mt-20">
                                <a href="#"><small>FORGOTTEN YOUR PASSWORD?</small></a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="account-create text-center pt-50">
                        <h4>DON'T HAVE AN ACCOUNT?</h4>
                        <p>Add items to your wishlistget personalised recommendations <br>
                            check out more quickly track your orders register</p>
                        <div class="btn-wrapper">
                            <a href="register.html" class="theme-btn-1 btn black-btn">CREATE ACCOUNT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
