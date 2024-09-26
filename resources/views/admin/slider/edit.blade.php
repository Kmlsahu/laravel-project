@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h3>Slider Edit</h3>
    <form role="form" action="{{ route('slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8 box box-primary">
                <div class="form-group">
                    <label for="exampleInputTitle1">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleInputTitle1" placeholder="Enter title" value="{{ $slider->title }}">
                    @error('title')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile1">File input</label>
                    <img src="{{$slider->getFirstMediaUrl('image')}}" width="120px">
                    <input type="file" name="image" class="form-control" id="exampleInputFile1">
                </div>
                <div class="form-group">
                    <label for="exampleInputOrdering1">Ordering</label>
                    <input type="number" name="ordering" class="form-control" id="exampleInputOrdering1" value="{{ $slider->ordering }}">
                    @error('ordering')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputStatus1">Status</label>
                    <select name="status" id="exampleInputStatus1" class="form-control">
                        <option value="" selected disabled>Status</option>
                        <option value="1" {{ ($slider->status==1)?'selected':NULL }}>Enable</option>
                        <option value="2" {{ ($slider->status==2)?'selected':NULL }}>Disable</option>
                    </select>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection