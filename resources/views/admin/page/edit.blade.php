@extends('layouts.admin')
@section('content')
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<section class="content-header">
    <h3>Page Edit</h3>
    <form role="form" action="{{ route('page.update', $page->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8 box box-primary">
                <div class="form-group">
                    <label for="exampleInputTitle1">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleInputTitle1" value="{{ $page->title }}">
                    @error('title')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputHeading1">Heading</label>
                    <input type="text" name="heading" class="form-control" id="exampleInputHeading1" value="{{ $page->heading }}">
                    @error('heading')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputDescription1">Description</label>
                    <textarea type="text" name="description" class="form-control" id="exampleInputDescription1" value="{{ $page->description }}">{{ $page->description }}</textarea>
                    <script>
                        CKEDITOR.replace('description');
                    </script>
                    @error('description')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Banner Image</label>
                    <img src="{{$page->getFirstMediaUrl('image')}}" width="120px">
                    <input type="file" name="image" class="form-control" id="exampleInputFile">
                </div>
                <div class="form-group">
                    <label for="exampleInputOrdering1">Ordering</label>
                    <input type="number" name="ordering" class="form-control" id="exampleInputOrdering1" value="{{ $page->ordering }}">
                    @error('ordering')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputStatus1">Status</label>
                    <select name="status" id="exampleInputStatus1" class="form-control">
                        <option value="" selected disabled>Status</option>
                        <option value="1" {{ ($page->status == 1) ? 'selected' : NULL }}>Enable</option>
                        <option value="2" {{ ($page->status == 2) ? 'selected' : NULL }}>Disable</option>
                    </select>
                    @error('status')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputUrl_key1">Url Key</label>
                    <input type="text" name="url_key" class="form-control" id="exampleInputUrl_key1">
                    @error('url_key')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection