@extends('master')

@section('insider')
    <div class="content-wrapper mb-2 mr-2">
            <!-- Content Header (Page header) -->
        <section class="content-header  mt-2 mr-2">
            <div class="container-fluid">
                <div class="row mb-2">
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
                            <div class="input-group input-group-sm">
                                <input type="text" name="table_search" class="form-control" placeholder="Search">
                                <span class="input-group-prepend"><i class="input-group-text fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body table-responsive p-0 ml-1">
                        <table class="table table-hover text-nowrap">
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
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <a href="{{ "delete/".$product['id'] }}" class="btn btn-danger">Yes</a>
                </div>
            </div>
        </div>
    </div>
    
@endsection
