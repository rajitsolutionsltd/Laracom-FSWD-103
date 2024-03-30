@extends('frontEnd.layouts.masters')

@section('content')

<div class="container" style="padding-top:150px;">
    <div class="row">
        <div class="col-12">
            <button onclick="
            document.getElementById('logout').submit();
            ">Logout</button>

            <form action="{{ route('customer.logout') }}" method="post" id="logout" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>

@endsection