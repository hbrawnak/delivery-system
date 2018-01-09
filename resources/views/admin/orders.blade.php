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
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">
                        {{ Session::get('error') }}
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
                                    <th>After Charge</th>
                                    <th>Returned</th>
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
                                        <td>
                                            @if($delivery->status != 'Returned')
                                            {{ $delivery->after_charging_amount }}
                                            @endif
                                        </td>

                                        <td>{{ $delivery->returned_on }}</td>
                                        <td>

                                            <div class="dropdown">
                                                <button class="btn btn-default" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-cogs" aria-hidden="true"></i>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    @if($delivery->status == 'Pending')
                                                    <li><a href="{{ route('updateStatus', ['id' => $delivery->id]) }}">Received</a></li>
                                                    @elseif($delivery->status == 'Received')
                                                    <li><a href="{{ route('updateStatus', ['id' => $delivery->id]) }}">Pending</a></li>
                                                    @endif
                                                    <li><a href="{{ route('progress', ['id' => $delivery->id]) }}">In Progress</a></li>
                                                    <li><a href="{{ route('delivered', ['id' => $delivery->id]) }}">Delivered</a></li>
                                                     <li role="separator" class="divider"></li>
                                                    <li><a href="{{ route('returned', ['id' => $delivery->id]) }}">Return</a></li>
                                                </ul>
                                            </div>


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
