@extends('layouts.admin')
@section('content')
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<section class="content-header">
    <h3>Category Add</h3>
    <form role="form" action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8 box box-primary">
                <div class="form-group">
                    <label for="exampleInputCategory_Parent_Id1">Category Parent Id</label>
                   
                    <select name="category_parent_id" id="category_parent_id" class="form-control">
                        <option value="" selected disabled>Please Select Category</option>
                       
                        @foreach($allcate as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="name" name="name" class="form-control" id="exampleInputName1" placeholder="Enter Name" value="{{old('name')}}">
                    @error('name')
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

                <div class="form-group">
                    <label for="exampleInputShow_in_menu1">Show In Menu</label>
                    <select name="show_in_menu" id="exampleInputShow_in_menu1" class="form-control">
                        <option value="" selected disabled>Select Menu</option>
                        <option value="1" {{ old('show_in_menu') == 1 ? 'selected' : '' }}>Yes
                        </option>
                        <option value="2" {{ old('show_in_menu') == 2 ? 'selected' : '' }}>No
                        </option>
                    </select>
                    @error('show_in_menu')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputShort_description1">Short Description</label>
                    <textarea name="short_description" id="exampleInputShort_description1" class="form-control" cols="10" rows="2">{{ old('short_description') }}</textarea>
                    @error('short_description')
                    <span class="text-danger">{{ $message }}</span>
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
                    <label for="exampleInputUrl_key1">Url Key</label>
                    <input type="text" name="url_key" class="form-control" id="exampleInputUrl_key1">
                    @error('url_key')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputMeta_tag1">Meta Tag</label>
                    <input type="text" name="meta_tag" class="form-control" id="exampleInputMeta_tag1" placeholder="Enter Meta Tag" value="{{old('meta_tag')}}">
                    @error('meta_tag')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputMeta_title1">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" id="exampleInputMeta_title1" placeholder="Enter Meta Title" value="{{old('meta_title')}}">
                    @error('meta_title')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputMeta_description1">Meta Description</label>
                    <input type="text" name="meta_description" class="form-control" id="exampleInputMeta_description1" placeholder="Enter Meta Title" value="{{old('meta_description')}}">
                    @error('meta_description')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputthumbmnail_image1">Thumbmnail Image</label>
                    <input type="file" name="thumbnail_image" class="form-control" id="exampleInputthumbmnail_image1">
                </div>

                <div class="form-group">
                    <label for="exampleInputCategory_image1">Category Image</label>
                    <input type="file" name="image[]" class="form-control" id="exampleInputCategory_image1" multiple>
                </div>

                <div class="form-group">
                    <label for="categorys">Select Product:</label>
                    <select name="products[]"  class="form-control" multiple>
                        @foreach($products as $_product)
                            <option value="{{$_product->id}}">{{$_product->name}}</option>
                        @endforeach
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
