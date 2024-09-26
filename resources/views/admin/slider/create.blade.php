@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h3>Slider Add</h3>
    <form role="form" action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8 box box-primary">
                <div class="form-group">
                    <label for="exampleInputName1">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleInputTitle1" value="{{old('title')}}">
                    @error('title')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <input type="file" name="image" class="form-control" id="exampleInputFile">
                </div>
                <div class="form-group">
                    <label for="exampleInputOrdering1">Ordering</label>
                    <input type="number" name="ordering" class="form-control" id="exampleInputOrdering1" value="{{old('ordering')}}">
                    @error('ordering')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputStatus1">Status</label>
                    <select name="status" id="exampleInputStatus1" class="form-control">
                        <option value="" selected disabled>Status</option>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Enable</option>
                        <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Disable</option>
                    </select>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection