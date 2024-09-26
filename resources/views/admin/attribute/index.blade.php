@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h1>Attribute List</h1>
                </div>
                <div class="box-body table-responsive no-padding">
                    @can("attribute_create")
                    <h4><a href="{{ route('attribute.create') }}">+Add Attribute</a></h4>
                    @endcan

                    @if(Session::has('success'))
                    <span style="color:green">{{ Session::get('success') }}</span>
                    @endif
                    <table class="table table-hover attributeTable">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                                <th>Name Key</th>
                                <th>Is Variant</th>
                                <th>Status</th>
                                <th>Attribute Value</th>
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

        var table = $('.attributeTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('attribute.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'name_key',
                    name: 'name_key'
                },
                {
                    data: 'is_variant',
                    name: 'is_variant'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'attributevalues',
                    name: 'attributevalues'
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