@extends('layouts.admin')
@section('content')
<section class="content-header">
    <form role="form" action="{{ route('permission.update', $permission->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8 box box-primary">
                <div class="form-group">
                    <h3>Permission Edit</h3>
                    <label for="exampleInputName1">Name</label>
                    <input type="name" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{ $permission->name }}">
                    @error('name')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection