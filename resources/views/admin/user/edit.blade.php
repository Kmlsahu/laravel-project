@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h3>User Edit</h3>
    <form role="form" action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8 box box-primary">
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="name" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{ $user->name }}">
                    @error('name')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{ $user->email }}">
                    @error('email')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    @error('password')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile1">File input</label>
                    <img src="{{$user->getFirstMediaUrl('image')}}" width="120px">
                    <input type="file" name="image" class="form-control" id="exampleInputFile1">
                </div>
                <div class="form-group">
                    <h5>Select Role</h5>
                    @foreach($roles as $_role)
                    <input type="checkbox" name="roles[]" value="{{$_role->name}}" {{ in_array($_role->id, $user->roles->pluck('id')->toArray())? 'checked':''}}> {{$_role->name}}<br>
                    @endforeach
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection