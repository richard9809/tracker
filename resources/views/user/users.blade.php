@extends('master')

@section('insider')

    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        <section class="content-header  mt-2 mr-2">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (Auth::user()->role == 'Teller')
                            <h1>View Customers</h1>
                        @endif

                        @if (Auth::user()->role == 'Admin')
                            <h1>View Users</h1>
                        @endif

                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            
                            @if (Auth::user()->role == 'Teller')
                                <li class="breadcrumb-item"><a href="{{ route('user.addUser') }}">Add Customer</a></li>
                                <li class="breadcrumb-item active">View Customers</li>
                            @endif

                            @if (Auth::user()->role == 'Admin')
                                <li class="breadcrumb-item"><a href="{{ route('user.addUser') }}">Add User</a></li>
                                <li class="breadcrumb-item active">View Users</li>
                            @endif
                            
                        </ol>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>

        <div class="row mr-2">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        @if (Auth::user()->role == 'Teller')
                            <h3 class="card-title">Customers Table</h3>  
                        @endif

                        @if (Auth::user()->role == 'Admin')
                            <h3 class="card-title">Users Table</h3>  
                        @endif

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
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone No.</th>
                                <th>County</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            
                            @foreach ($users as $user)
                                <tbody>
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user->fname }} </td>
                                        <td>{{ $user->lname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->telephone }}</td>
                                        <td>{{ $user->county }}</td>
                                        <td>
                                            <a href="{{ "editUser/".$user['id'] }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                            <!-- Button trigger modal -->
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
                    <h5 class="modal-title" id="exampleModalLabel">
                        @if (Auth::user()->role == 'Admin')
                            Delete User
                        @endif

                        @if (Auth::user()->role == 'Teller')
                            Delete Customer
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <a href="{{ "deleteUser/".$user['id'] }}" class="btn btn-danger">Yes</a>
                </div>
            </div>
        </div>
    </div>

@endsection