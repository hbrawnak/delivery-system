@extends('user.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content">
            <div class="row">
                <div class="col-sm-8 col-md-offset-2 userDetail">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">New Delivery</h3>
                        </div>

                        <div class="panel-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif

                            <form method="post" action="{{ route('postNewDelivery') }}" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="recipient_name" class="form-control" id="inputEmail3" placeholder="Recipient Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Number</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="recipient_mobile" class="form-control" id="inputEmail3" placeholder="Recipient Mobile">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="recipient_address" id="" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="password" class="form-control" id="inputPassword3" disabled value="Pending">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Amount</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="amount" class="form-control" id="inputPassword3" placeholder="Amount">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-default">Create</button>
                                    </div>
                                </div>
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
