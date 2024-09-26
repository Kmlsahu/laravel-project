@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h3>Attribute Value Add</h3>
    <form role="form" action="{{ route('attribute_value.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8 box box-primary">
                <div class="form-group">
                    <label for="exampleInputAttribute_Name1">Attribute Name</label>
                    <select name="attribute_id" id="exampleInputAttribute_Name1" class="form-control">
                        <option value="" selected disabled>---Select Attribute---</option>
                        @foreach($attribute as $_attribute)
                        <option value="{{ $_attribute->id }}">{{$_attribute->name }}</option>
                        @endforeach
                    </select>

                    @error('attribute_id')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
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

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection