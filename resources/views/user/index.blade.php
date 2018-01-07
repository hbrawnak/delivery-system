@extends('user.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green-gradient">
                        <div class="inner">
                            <h3>{{ $total_delivery }}</h3>
                            <p>Total Delivery</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua-gradient">
                        <div class="inner">
                            <h3>{{ $pending_delivery }}</h3>
                            <p>Pending Delivery</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $received_delivery }}</h3>
                            <p>Received Delivery</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow-gradient">
                        <div class="inner">
                            <h3>{{ $inprogress_delivery }}</h3>
                            <p>In Progress Delivery</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red-gradient">
                        <div class="inner">
                            <h3>{{ $delivered }}</h3>
                            <p>Completed Delivery</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $returned_delivered }}</h3>
                            <p>Delivery Returned</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green-gradient">
                        <div class="inner">
                            <h3>{{ $delivery_amount_done }} <small>Taka</small></h3>
                            <p>Total Delivery Amount</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-gray-active">
                        <div class="inner">
                            <h3>{{ $delivery_amount_returned }} <small>Taka</small></h3>
                            <p>Returned Delivery Amount</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->

            {{--<div class="row">--}}

                {{----}}

            {{--</div>--}}

        </section>
        <!-- /.content -->
    </div>
@endsection