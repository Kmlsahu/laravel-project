@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h1>Role List</h1>
                </div>
                <div class="box-body table-responsive no-padding">
                    @can("role_create")
                    <h4><a href="{{ route('role.create') }}">+Add Role</a></h4>
                    @endcan

                    @if(Session::has('success'))
                    <span style="color:green">{{ Session::get('success') }}</span>
                    @endif
                    <table class="table table-hover roletable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

<script type="text/javascript">
    $(function() {
        var table = $('.roletable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('role.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'permissions',
                    name: 'permissions'
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