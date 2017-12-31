@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{--<section class="content-header col-md-offset-2">--}}
        {{--<h3>--}}
        {{--User details--}}
        {{--</h3>--}}
        {{--</section>--}}
        <section class="content">
            <div class="row">
                <div class="col-sm-8 col-md-offset-2 userDetail">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Text Message</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('updateSMS') }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <textarea class="form-control" name="text" id="text" rows="5">{{ $text->message }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-success pull-right">Update</button>
                            </form>
                        </div>
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
