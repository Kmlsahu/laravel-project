@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h1>Block List</h1>
                </div>
                <div class="box-body table-responsive no-padding">
                
                    <h4><a href="{{ route('block.create') }}">+Add Block</a></h4>
                    

                    @if(Session::has('success'))
                    <span style="color:green">{{ Session::get('success') }}</span>
                    @endif
                    <table class="table table-hover blockTable">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Identifier</th>
                                <th>Title</th>
                                <th>Heading</th>
                                <th>Banner Image</th>
                                <th>Ordering</th>
                                <th>Status</th>
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
</section>
@endsection

@section('script')
<script type="text/javascript">
    $(function() {
        var table = $('.blockTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('block.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'identifier',
                    name: 'identifier'
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
                    data: 'block_image',
                    name: 'block_image'
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