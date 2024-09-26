@extends('layouts.admin')
@section('content')
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<section class="content-header">
    <h3>Product Add</h3>
    <form role="form" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8 box box-primary">
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
                    <label for="exampleInputIs_Featured1">Is Featured</label>
                    <select name="is_featured" id="exampleInputIs_Featured1" class="form-control">
                        <option value="" selected disabled>Select Feature</option>
                        <option value="1" {{ old('is_featured') == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="2" {{ old('is_featured') == 2 ? 'selected' : '' }}>No</option>
                    </select>
                    @error('status')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputSku1">Sku</label>
                    <input type="text" name="sku" class="form-control" id="exampleInputSku1" placeholder="Enter Sku" value="{{old('sku')}}">
                    @error('sku')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputQty1">Qty</label>
                    <input type="number" name="qty" class="form-control" id="exampleInputQty1" placeholder="Enter Oty" value="{{old('qty')}}">
                    @error('qty')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputStock_Status1">Stock Status</label>
                    <select name="stock_status" id="exampleInputStock_Status1" class="form-control">
                        <option value="" selected disabled>Select Stock</option>
                        <option value="1" {{ old('stock_status') == 1 ? 'selected' : '' }}>In stock</option>
                        <option value="2" {{ old('stock_status') == 2 ? 'selected' : '' }}>Out of stock</option>
                    </select>
                    @error('stock_status')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputWeight1">Weight</label>
                    <input type="number" name="weight" class="form-control" id="exampleInputWeight1" placeholder="Enter Weight" value="{{old('weight')}}">
                    @error('weight')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPrice1">Price</label>
                    <input type="number" name="price" class="form-control" id="exampleInputPrice1" placeholder="Enter Price" value="{{old('price')}}">
                    @error('price')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputSpecial_Price1">Special Price</label>
                    <input type="number" name="special_price" class="form-control" id="exampleInputSpecial_Price1" placeholder="Enter Special Price" value="{{old('price')}}">
                    @error('special_price')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputSpecial_Price_From1">Special Price From</label>
                    <input type="datetime-local" name="special_price_from" class="form-control" id="exampleInputSpecial_Price_From1" value="{{old('special_price_from')}}">
                    @error('special_price_from')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputSpecial_Price_To1">Special Price To</label>
                    <input type="datetime-local" name="special_price_to" class="form-control" id="exampleInputSpecial_Price_To1" value="{{old('special_price_to')}}">
                    @error('special_price_to')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputShort_description1">Short Description</label>
                    <textarea name="short_description" id="exampleInputShort_description1" class="form-control" cols="10" rows="2">{{ old('short_description') }}</textarea>
                    @error('short_description')
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
                    <label for="exampleInputRelated_product1">Related Product</label>

                    <select name="related_product[]" class="form-control" multiple>
                        @foreach($product as $_product)
                         <option value="{{ $_product->id }}">{{ $_product->name }}</option>
                        @endforeach
                    </select>
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
                    <textarea name="meta_description" id="exampleInputMeta_description1" class="form-control" cols="30" rows="2">{{ old('meta_description') }}</textarea>
                    @error('meta_description')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputthumbmnail_image1">Thumbmnail Image</label>
                    <input type="file" name="thumbnail_image" class="form-control" id="exampleInputthumbmnail_image1">
                </div>

                <div class="form-group">
                    <label for="exampleInputProduct_image1">Product Image</label>
                    <input type="file" name="image[]" class="form-control" id="exampleInputProduct_image1" multiple>
                </div>

                <div class="form-group">
                    <label for="categorys">Select Category:</label>
                    <select name="categories[]"  class="form-control" multiple>
                        @foreach($categories as $_category)
                            <option value="{{$_category->id}}">{{$_category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="attribute">Attribute :</label>
                    @foreach($attributes as $attribute)
                    {{-- <input type="hidden" name="attribute[]" value="{{ $attribute->id }}"> --}}
                    <h5>{{ $attribute->name }}</h5>
                    @foreach($attribute->attributeValues as $attributevalue)
                    <input type="checkbox" name="attributevalue[]" value="{{$attributevalue->id}}">{{$attributevalue->name}}
                    @endforeach
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