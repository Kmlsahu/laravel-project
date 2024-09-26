@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h1>Product List</h1>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        @can('category_create')
                            <h4><a href="{{ route('product.create') }}">+Add Product</a></h4>
                        @endcan

                        @if (Session::has('success'))
                            <span style="color:green">{{ Session::get('success') }}</span>
                        @endif
                        <table class="table table-hover productTable">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Is Featured</th>
                                    <th>Sku</th>
                                    <th>Qty</th>
                                    <th>Stock Status</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                    <th>Special Price</th>
                                    <th>Related Product</th>
                                    <th>Url Key</th>
                                    <th>Thumbmnail Image</th>
                                    <th>Image</th>
                                    <th>Category</th>
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

            var table = $('.productTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
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
                        data: 'is_featured',
                        name: 'is_featured'
                    },
                    {
                        data: 'sku',
                        name: 'sku'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'stock_status',
                        name: 'stock_status'
                    },
                    {
                        data: 'weight',
                        name: 'weight'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'special_price',
                        name: 'special_price'
                    },
                    {
                        data: 'related_product',
                        name: 'related_product'
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
                        data: 'product_image',
                        name: 'product_image'
                    },
                    {
                        data: 'categories',
                        name: 'categories'
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
