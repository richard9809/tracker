@extends('master')

@section('insider')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header mt-2 mr-2">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Generate Barcode</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('user.userHome') }}">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content d-flex justify-content-center mt-2">
            <div class="container-fluid">
                <div class="row ">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- jquery validation -->
                    <div class="card card-primary ">
                        <div class="card-header d-flex justify-content-center">
                            <h3 class="card-title">Add Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('user.checkBarcode') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputsize4">Size</label>
                                        <select id="inputsize4" class="form-control" name="size">
                                            <option selected value="300ML">300ML</option>
                                            <option value="500ML">500ML</option>
                                            <option value="1L">1L</option>
                                            <option value="5L">5L</option>
                                            <option value="10L">10L</option>
                                            <option value="20L">20L</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputprice4">Price</label>
                                        <input type="number" class="form-control" id="inputprice4" name="price" placeholder="Price" required>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                    </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection