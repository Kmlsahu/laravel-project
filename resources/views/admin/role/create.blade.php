@extends('layouts.admin')
@section('content')
<section class="content-header">
    <form role="form" action="{{ route('role.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8 box box-primary">
                <div class="form-group">
                    <h3>Role Add</h3>
                    <label for="exampleInputName1">Name</label>
                    <input type="name" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{old('name')}}">
                    @error('name')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <h5>Permission List</h5>
                    @foreach($permissions as $permission)
                    <input type="checkbox" name="permissions[]" value="{{$permission->name}}"> {{$permission->name}}<br>
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