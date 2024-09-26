@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h1>Page List</h1>
                </div>
                <div class="box-body table-responsive no-padding">
                    @can("page_create")
                    <h4><a href="{{ route('page.create') }}">+Add Page</a></h4>
                    @endcan

                    @if(Session::has('success'))
                    <span style="color:green">{{ Session::get('success') }}</span>
                    @endif
                    <table class="table table-hover pageTable">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Title</th>
                                <th>Heading</th>
                                <th>Banner Image</th>
                                <th>Ordering</th>
                                <th>Status</th>
                                <th>Url_key</th>
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

        var table = $('.pageTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('page.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'heading',
                    name: 'heading'
                },
                {
                    data: 'page_image',
                    name: 'page_image'
                },
                {
                    data: 'ordering',
                    name: 'ordering'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'url_key',
                    name: 'url_key'
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