@extends('layouts.web')


@section('content')
    <div class="col-sm-12">
        <div class="title-left">
            <h3>Account Login</h3>
        </div>

        @if (session()->has('error'))
            <p
                style="background: #FFD333;
            padding: 15px;
            color: #FF0000;
            font-weight: 500;">
                {{ session()->get('error') }}</p>
        @endif
        @if (session()->has('success'))
            <p
                style="background: #FFD333;
            padding: 15px;
            color: #000;
            font-weight: 500;">
                {{ session()->get('success') }}</p>
        @endif
        {{-- <h5><a data-toggle="collapse" href="#formLogin" role="button" aria-expanded="false">Click here to
            Login</a></h5> --}}
        <form action="{{ route('customer.authenticate') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="InputEmail" class="mb-0">Email Address</label>
                    <input type="email" class="form-control" name="email" id="InputEmail" placeholder="Enter Email">
                </div>
                <div class="form-group col-md-6">
                    <label for="InputPassword" class="mb-0">Password</label>
                    <input type="password" class="form-control" name="password" id="InputPassword" placeholder="Password">
                </div>
            </div>
            <button type="submit" class="btn hvr-hover">Login</button>
            <a href="{{ route('customer.create') }}" class="btn btn-primary">Create Account</a>
        </form>
    </div>
@endsection
