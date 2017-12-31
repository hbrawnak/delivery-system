@extends('user.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{--<section class="content-header">--}}
            {{--<h1>--}}
                {{--Users Table--}}
            {{--</h1>--}}
        {{--</section>--}}

        <!-- Main content -->
        <section class="content">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    <div class="col-md-4 col-md-offset-4 error">
                        {{ Session::get('error') }}
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12">
                    <a href="{{ route('user.create') }}" class="btn btn-success pull-right"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create User</a>
                    <br>
                    <br>
                    <div class="box">
                    {{--<div class="box-header">--}}
                    {{--<h3 class="box-title">Data Table With Full Features</h3>--}}
                    {{--</div>--}}
                    {{--<!-- /.box-header -->--}}
                        <div class="box-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
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
