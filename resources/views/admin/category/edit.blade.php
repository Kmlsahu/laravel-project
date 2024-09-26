@extends('layouts.admin')
@section('content')
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<section class="content-header">
    <h3>Category Edit</h3>
    <form role="form" action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8 box box-primary">
                <div class="form-group">
                    <label for="exampleInputCategory_Parent_Id1">Category Parent Id</label>
                   
                    <select name="category_parent_id" id="category_parent_id" class="form-control">
                        <option value="">Please Select Category</option>
                        @foreach($allcate as $cate)
                            <option value="{{$cate->id}}" {{ $cate->id == $category->category_parent_id ? 'selected' : '' }}>
                                {{$cate->name}}
                            </option>
                        @endforeach
                    </select>
                    
                </div>

                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="name" name="name" class="form-control" id="exampleInputName1" placeholder="Enter Name" value="{{ $category->name }}">
                    @error('name')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputStatus1">Status</label>
                    <select name="status" id="exampleInputStatus1" class="form-control">
                        <option value="" selected disabled>Status</option>
                        <option value="1" {{ ($category->status==1)?'selected':NULL }}>Enable</option>
                        <option value="2" {{ ($category->status==2)?'selected':NULL }}>Disable</option>
                    </select>
                    @error('status')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputShow_in_menu1">Show In Menu</label>
                    <select name="show_in_menu" id="exampleInputShow_in_menu1" class="form-control">
                        <option value="" selected disabled>Select Menu</option>
                        <option value="1" {{ ($category->show_in_menu==1)?'selected':NULL }}>Yes
                        </option>
                        <option value="0" {{ ($category->show_in_menu==0)?'selected':NULL }}>No
                        </option>
                    </select>
                    @error('show_in_menu')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputShort_description1">Short Description</label>
                    <textarea name="short_description" id="exampleInputShort_description1" class="form-control" cols="10" rows="2">{{ $category->short_description }}</textarea>
                    @error('short_description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputDescription1">Description</label>
                    <textarea name="description" class="form-control" id="exampleInputDescription1">{{ $category->description }}</textarea>
                    <script>
                        CKEDITOR.replace('description');
                    </script>
                    @error('description')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- <div class="form-group">
                    <label for="exampleInputUrl_key1">Url Key</label>
                    <input type="text" name="url_key" class="form-control" id="exampleInputUrl_key1">
                    @error('url_key')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div> -->

                <div class="form-group">
                    <label for="exampleInputMeta_tag1">Meta Tag</label>
                    <input type="text" name="meta_tag" class="form-control" id="exampleInputMeta_tag1" placeholder="Enter Meta Tag" value="{{ $category->meta_tag }}">
                    @error('meta_tag')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputMeta_title1">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" id="exampleInputMeta_title1" placeholder="Enter Meta Title" value="{{ $category->meta_title }}">
                    @error('meta_title')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputMeta_description1">Meta Description</label>
                    <textarea name="meta_description" id="exampleInputMeta_description1" class="form-control" cols="30" rows="2">{{ $category->meta_description }}</textarea>
                    @error('meta_description')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputthumbmnail_image1">Thumbmnail Image</label>
                    <img src="{{$category->getFirstMediaUrl('thumbnail_image')}}" width="120px">
                    <input type="file" name="thumbnail_image" class="form-control" id="exampleInputthumbmnail_image1">
                </div>

                <div class="form-group">
                    <label for="exampleInputexisting_category_image1">Existing Category Images:</label>
                    <div class="row">
                        @foreach($image as $image)
                        <div class="col-md-3 mb-3">
                            <img src="{{ $image->getUrl() }}" class="img-thumbnail" alt="Image" width="100px">
                            <div class="mt-2">
                                <input type="checkbox" name="remove_image[]" value="{{ $image->id }}" id="exampleInputexisting_category_image1">
                                <label for="remove_image[]">Remove</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputupload_new_category_image1">Upload New Category Images:</label>
                    <input type="file" name="new_image[]" id="exampleInputupload_new_category_image1" class="form-control" multiple>
                </div>

                <div class="form-group">
                    <label for="categorys">Select Product:</label>
                    <select name="products[]"  class="form-control" multiple>
                        @foreach($products as $_product)
                            <option value="{{$_product->id}}"{{ in_array($_product->id, $category->products->pluck('id')->toArray())? 'selected':''}}>{{$_product->name}}</option>
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