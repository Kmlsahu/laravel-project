@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    {{-- @can("slider_create") --}}
                    <h1>Slider List</h1>
                    {{-- @endcan --}}
                </div>
                <div class="box-body table-responsive no-padding">
                    <h4><a href="{{ route('slider.create') }}">+Add Slider</a></h4>

                    @if(Session::has('success'))
                    <span style="color:green">{{ Session::get('success') }}</span>
                    @endif
                    <table class="table table-hover sliderTable">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Title</th>
                                <th>Slider Image</th>
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
        var table = $('.sliderTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('slider.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'slider_image',
                    name: 'slider_image'
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