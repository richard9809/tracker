@extends('master')

@section('insider')
    <div class="content-wrapper mb-2 mr-2">
            <!-- Content Header (Page header) -->
        <section class="content-header mr-2">
            <div class="container-fluid">
                <div class="row mb-1">
                    <div class="col-sm-6">
                        <h1>View Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('user.addProduct') }}">Add Product</a></li>
                            <li class="breadcrumb-item active">View Products</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="row mr-2">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Products Table</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body table-responsive p-0 ml-1 mb-1"  style="height: 500px;">
                        <table class="table table-head-fixed table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Barcode No.</th>
                                    <th>Barcode</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            
                            @foreach ($products as $product)
                                <tbody>
                                    <tr>
                                        <td>{{ $product->barcode }}</td>
                                        <td>
                                            {!! DNS1D::getBarcodeHTML( $product->barcode , 'UPCA') !!}
                                        </td>
                                        <td>{{ $product->size }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <a href="{{ "edit/".$product['id'] }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach

                        </table>

                    </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>

    
@endsection
