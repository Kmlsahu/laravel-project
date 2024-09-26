@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h3>Attribute Add</h3>
    <form role="form" action="{{ route('attribute.store') }}" method="post">
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
                    <label for="exampleInputName_key1">Name Key</label>
                    <input type="name" name="name_key" class="form-control" id="exampleInputName_key1" placeholder="Enter Name Key" value="{{old('name_key')}}">
                    @error('name_key')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputIs_Variant1">Is Variant</label>
                    <select name="is_variant" id="exampleInputIs_Variant1" class="form-control">
                        <option value="" selected disabled>Select Menu</option>
                        <option value="1" {{ old('is_variant') == 1 ? 'selected' : '' }}>Yes
                        </option>
                        <option value="2" {{ old('is_variant') == 2 ? 'selected' : '' }}>No
                        </option>
                    </select>
                    @error('is_variant')
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

                <table>
                    <tr>
                        <th>Attribute value</th>
                        <td>
                            <table id="attributevalue_add">
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th><button type="button" class="add_more">+</button></th>
                                </tr>

                                <tr>
                                    <td><input type="text" name="atrname[]"></td>
                                    <td>
                                        <select name="status1[]">
                                            <option value="" selected disabled>Status</option>
                                            <option value="1">Enable</option>
                                            <option value="2">Disable</option>
                                        </select>
                                    </td>

                                    <td>
                                        <button type="button" class="remove">X</button>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</section>


<script>
    $(document).ready(function() {
        $('.add_more').click(function() {
            row = `<tr>
                            <td><input type="text" name="atrname[]"></td>
                            <td>
                                <select name="status1[]">
                                    <option value="1">Enable</option>
                                    <option value="2">Disable</option>
                                </select>
                            </td>

                            <td>
                                <button type="button" class="remove">X</button>
                            </td>
                        </tr>`;

            $('#attributevalue_add').append(row);

        });
        $('#attributevalue_add').delegate('.remove', 'click', function() {
            $(this).closest('tr').remove();

        });
    });
</script>

@endsection