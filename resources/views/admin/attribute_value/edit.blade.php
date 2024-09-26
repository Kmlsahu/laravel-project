@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h3>Attribute Value Edit</h3>
    <form role="form" action="{{ route('attribute_value.update', $attribute_value->id ) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8 box box-primary">
                <div class="form-group">
                    <label for="exampleInputName1">Attribute Name</label>
                    <select name="attribute_id" id="exampleInputAttribute_Id1" class="form-control">
                        @foreach($attribute as $_attribute)
                        <option value="{{ $_attribute->id }}" {{ $attribute_value->attribute_id == $_attribute->id ? 'selected' : '' }}>{{ $_attribute->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="name" name="name" class="form-control" id="exampleInputName1" placeholder="Enter Name" value="{{ $attribute_value->name }}">
                    @error('name')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputStatus1">Status</label>
                    <select name="status" id="exampleInputStatus1" class="form-control">
                        <option value="" selected disabled>Status</option>
                        <option value="1" {{ ($attribute_value->status==1)? 'selected':NULL }}>Enable</option>
                        <option value="2" {{ ($attribute_value->status==2)? 'selected':NULL }}>Disable</option>
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