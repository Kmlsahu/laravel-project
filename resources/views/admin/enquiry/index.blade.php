@extends('layouts.admin')

@section('content')

<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Enquiry List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Sr.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Messages</th>
                                <th>Status</th>
                                <th>Action</th>


                            </tr>


                            @foreach ($enquiries as $key => $enquiry)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $enquiry->name }}</td>
                                <td>{{ $enquiry->email }}</td>
                                <td>{{ $enquiry->subject}}</td>
                                <td>{{ $enquiry->message }}</td>
                                <td id="status_id{{ $enquiry->id }}">
                                    @if ($enquiry->status == 1)
                                    <a href="{{ route('enquiry-status',$enquiry->id) }}" >Unread</a>
                                    @else
                                    <button class="btn btn-success">Read</button>
                                    @endif


                                </td>
                                <td>
                                    <form action="{{route('enquiry-destroy',$enquiry->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>



</section>

@endsection