@extends('layouts.admin')
@section('content')
<section class="content-header">
    <form role="form" action="{{ route('permission.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8 box box-primary">
                <div class="form-group">
                    <h3>Permission Add</h3>
                    <table id="permission_add">
                        <tr>
                            <th>Name</th>
                            <th><button type="button" class="add_more">+</button></th>
                        </tr>
                        <tr>
                            <td><input type="text" name="name[]"></td>
                            <td>
                                <button type="button" class="remove">X</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.add_more').click(function() {
            row = `<tr>
                            <td><input type="text" name="name[]"></td>
                            

                            <td>
                                <button type="button" class="remove">X</button>
                            </td>
                        </tr>`;

            $('#permission_add').append(row);

        });
        $('#permission_add').delegate('.remove', 'click', function() {
            $(this).closest('tr').remove();

        });
    });
</script>

@endsection


<!-- 
<tr>
    <th>State:</th>
    <td>
        <table id="state_add">
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th><button type="button" class="add_more">+</button></th>
            </tr>

            <tr>
                <td><input type="text" name="state_name[]"></td>
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
</tr> -->