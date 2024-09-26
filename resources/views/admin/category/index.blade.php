@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h1>Category List</h1>
                </div>
                <div class="box-body table-responsive no-padding">
                    @can("category_create")
                    <h4><a href="{{ route('category.create') }}">+Add Category</a></h4>
                    @endcan

                    @if(Session::has('success'))
                    <span style="color:green">{{ Session::get('success') }}</span>
                    @endif
                    <table class="table table-hover categoryTable">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Category Parent Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Show In Menu</th>
                                <th>url_key</th>
                                <th>Thumbmnail Image</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

    </div>
    </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
    $(function() {

        var table = $('.categoryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('category.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'category_parent_id',
                    name: 'category_parent_id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'show_in_menu',
                    name: 'show_in_menu'
                },
                {
                    data: 'url_key',
                    name: 'url_key'
                },
                {
                    data: 'thumbnail_image',
                    name: 'thumbnail_image'
                },
                {
                    data: 'category_image',
                    name: 'category_image'
                },
                {
                    data: 'products',
                    name: 'products'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });

    });
</script>
@endsection