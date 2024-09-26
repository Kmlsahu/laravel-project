@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h1>Attribute Value List</h1>
                </div>
                <div class="box-body table-responsive no-padding">
                    @can("attribute_value_create")
                    <h4><a href="{{ route('attribute_value.create') }}">+Add Attribute Value</a></h4>
                    @endcan

                    @if(Session::has('success'))
                    <span style="color:green">{{ Session::get('success') }}</span>
                    @endif
                    <table class="table table-hover attribute_valueTable">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Attribute Name</th>
                                <th>Name</th>
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

    </div>
    </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
    $(function() {

        var table = $('.attribute_valueTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('attribute_value.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'attribute_name',
                    name: 'attribute_name'
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