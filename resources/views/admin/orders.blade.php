@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Delivery Table
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
            @if(Session::has('errorMessage'))
                <div class="alert alert-danger">
                    <div class="col-md-4 col-md-offset-4 error">
                        {{ Session::get('errorMessage') }}
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                    {{--<div class="box-header">--}}
                    {{--<h3 class="box-title">Data Table With Full Features</h3>--}}
                    {{--</div>--}}
                    <!-- /.box-header -->
                        <div class="box-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Consignment ID</th>
                                    <th>Delivery Man</th>
                                    <th>Recipient Name</th>
                                    <th>Recipient Mobile</th>
                                    <th>Recipient Address</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Charge</th>
                                    <th>After Charge</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($deliveries as $delivery)
                                    <tr>
                                        <td>{{ $delivery->consignment_id }}</td>
                                        <td>{{ $delivery->user->name }}</td>
                                        <td>{{ $delivery->recipient_name }}</td>
                                        <td>{{ $delivery->recipient_mobile }}</td>
                                        <td>{{ $delivery->recipient_address }}</td>
                                        <td>{{ $delivery->status }}</td>
                                        <td>{{ $delivery->amount }}</td>
                                        <td>{{ $delivery->charge }}</td>
                                        <td>{{ $delivery->after_charging_amount }}</td>
                                        <td>
                                            @if($delivery->status == 'Pending')
                                            <a href="{{ route('updateStatus', ['id' => $delivery->id]) }}" class="btn btn-danger">Done</a>
                                            @elseif($delivery->status == 'Done')
                                                <a href="{{ route('updateStatus', ['id' => $delivery->id]) }}" class="btn btn-info">Pending</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Consignment ID</th>
                                    <th>Delivery Man</th>
                                    <th>Recipient Name</th>
                                    <th>Recipient Mobile</th>
                                    <th>Recipient Address</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Charge</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
