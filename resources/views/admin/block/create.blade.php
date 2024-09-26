@extends('layouts.admin')
@section('content')
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<section class="content-header">
    <h3>Block Add</h3>
    <form role="form" action="{{ route('block.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8 box box-primary">
                <div class="form-group">
                    <label for="exampleInputIdentifier1">Identifier</label>
                    <input type="text" name="identifier" class="form-control" id="exampleInputIdentifier1" value="{{old('identifier')}}">
                    @error('identifier')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputTitle1">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleInputTitle1" value="{{old('title')}}">
                    @error('title')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputHeading1">Heading</label>
                    <input type="text" name="heading" class="form-control" id="exampleInputHeading1" value="{{old('heading')}}">
                    @error('heading')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputDescription1">Description</label>
                    <textarea name="description" class="form-control" id="exampleInputDescription1">{{old('description')}}</textarea>
                    <script>
                        CKEDITOR.replace('description');
                    </script>
                    @error('description')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Banner Image</label>
                    <input type="file" name="image" id="exampleInputFile">
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
                    @error('status')
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