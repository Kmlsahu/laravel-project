@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h1>Coupon List</h1>
                </div>
                <div class="box-body table-responsive no-padding">
                    @can("coupon_create")
                    <h4><a href="{{ route('coupon.create') }}">+Add Coupon</a></h4>
                    @endcan

                    @if(Session::has('success'))
                    <span style="color:green">{{ Session::get('success') }}</span>
                    @endif
                    <table class="table table-hover couponTable">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Coupon Code</th>
                                <th>Valid From</th>
                                <th>Valid To</th>
                                <th>Discount Amount</th>
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

        var table = $('.couponTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('coupon.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'coupon_code',
                    name: 'coupon_code'
                },
                {
                    data: 'valid_from',
                    name: 'valid_from'
                },
                {
                    data: 'valid_to',
                    name: 'valid_to'
                },
                {
                    data: 'discount_amount',
                    name: 'discount_amount'
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