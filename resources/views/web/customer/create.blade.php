@extends('layouts.web')


@section('content')

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Account</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->


    <div class="col-sm-12">
        <div class="title-left">
            <h3>Create New Account</h3>
        </div>
        {{-- <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Click here to
                Register</a></h5> --}}
                <form action="{{ route('customer.store') }}" method="POST">
                    @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="InputName" class="mb-0">Name</label>
                    <input type="text" class="form-control" id="InputName" name="name" placeholder="Name" value="{{ old('name') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="InputEmail1" class="mb-0">Email Address</label>
                    <input type="email" class="form-control" id="InputEmail1" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="InputPassword1" class="mb-0">Password</label>
                    <input type="password" class="form-control" id="InputPassword1" name="password" placeholder="Password" value="{{ old('password') }}">
                </div>
            </div>
            <button type="submit" class="btn hvr-hover">Register</button>
            <a href="{{ route('customer.login') }}" class="btn btn-primary">Login</a>
        </form>
    </div>
@endsection
