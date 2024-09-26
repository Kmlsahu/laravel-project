@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h1>Order List</h1>
                </div>

                <div class="box-body table-responsive no-padding">

                    <table class="table table-hover OrderTable">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Order Id</th>
                                <th>User Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>PinCode</th>
                                <th>Total</th>
                                <th>Order Date</th>
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
        var table = $('.OrderTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('order.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'order_increment_id',
                    name: 'order_increment_id'
                },
                {
                    data: 'user_id',
                    name: 'user_id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'state',
                    name: 'state'
                },
                {
                    data: 'pincode',
                    name: 'pincode'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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