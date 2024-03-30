@extends('frontEnd.layouts.masters')

@section('content')
    <div class="container" style="padding-top:150px;">
        <div class="row">
            <div class="col-12">
                <div class="ltn__checkout-single-content mt-50">
                    <h4 class="title-2">Billing Details</h4>
                    <div class="ltn__checkout-single-content-info">
                        <form action="{{ route('billing.details.store') }}" method="post">
                            @csrf
                            <h6>Personal Information</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" name="fname" placeholder="First name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" name="lname" placeholder="Last name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-item input-item-phone ltn__custom-icon">
                                        <input type="text" name="phone" placeholder="phone number">
                                    </div>
                                </div>


                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <h6>Address</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item">
                                                <input type="text" name="address1" placeholder="House number and street name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item">
                                                <input type="text" name="address2" placeholder="Apartment, suite, unit etc. (optional)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
