@extends('master')

@section('insider')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header mt-2 mr-2">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (Auth::user()->role == 'Admin')
                            <h1>Users</h1>
                        @endif
                        @if (Auth::user()->role == 'Teller')
                            <h1>Customers</h1>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('user.userHome') }}">Home</a></li>
                            @if (Auth::user()->role == 'Admin')
                                <li class="breadcrumb-item active">Users</li>
                            @endif
                            @if (Auth::user()->role == 'Teller')
                                <li class="breadcrumb-item active">Customers</li>
                            @endif
                            
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content mr-2">
            <div class="container-fluid">
                <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header justify-content-center">
                            @if (Auth::user()->role == 'Admin')
                                <h3 class="card-title">Update User</h3>
                            @endif
                            @if (Auth::user()->role == 'Teller')
                                <h3 class="card-title">Update Customer</h3>
                            @endif

                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if (Auth::user()->role == 'Admin')
                            <form action="{{ route('user.updateUser') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user['id'] }}">

                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                        <label for="inputfname4">First Name</label>
                                        <input type="text" class="form-control" id="inputfname4" name="fname" placeholder="First Name" value="{{ $user['fname'] }}">
                                        <div class="col-md-6">
                                            <span class="text-danger ">@error('fname'){{ $message }}@enderror</span>
                                        </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                        <label for="inputfname4">Last Name</label>
                                        <input type="text" class="form-control" id="inputfname4" name="lname" placeholder="Last Name" value="{{ $user['lname'] }}">
                                        <div class="col-md-6">
                                            <span class="text-danger ">@error('lname'){{ $message }}@enderror</span>
                                        </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputemail4">Email</label>
                                            <input type="email" class="form-control" id="inputemail4" name="email" placeholder="Email" value="{{ $user['email'] }}">
                                            <div class="col-md-6">
                                                <span class="text-danger ">@error('email'){{ $message }}@enderror</span>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputtel4">Telephone</label>
                                            <input type="text" class="form-control" id="inputtel4" name="telephone" placeholder="Telephone" value="{{ $user['telephone'] }}">
                                            <div class="invalid-feedback">
                                                Please provide telephone number
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputcounty4">County</label>
                                            <select id="inputcounty4" class="form-control" name="county">
                                                <option selected>{{ $user['county'] }}</option>
                                                <option value="baringo">Baringo</option>
                                                <option value="bomet">Bomet</option>
                                                <option value="bungoma">Bungoma</option>
                                                <option value="busia">Busia</option>
                                                <option value="elgeyo marakwet">Elgeyo Marakwet</option>
                                                <option value="embu">Embu</option>
                                                <option value="garissa">Garissa</option>
                                                <option value="homa bay">Homa Bay</option>
                                                <option value="isiolo">Isiolo</option>
                                                <option value="kajiado">Kajiado</option>
                                                <option value="kakamega">Kakamega</option>
                                                <option value="kericho">Kericho</option>
                                                <option value="kiambu">Kiambu</option>
                                                <option value="kilifi">Kilifi</option>
                                                <option value="kirinyaga">Kirinyaga</option>
                                                <option value="kisii">Kisii</option>
                                                <option value="kisumu">Kisumu</option>
                                                <option value="kitui">Kitui</option>
                                                <option value="kwale">Kwale</option>
                                                <option value="laikipia">Laikipia</option>
                                                <option value="lamu">Lamu</option>
                                                <option value="machakos">Machakos</option>
                                                <option value="makueni">Makueni</option>
                                                <option value="mandera">Mandera</option>
                                                <option value="meru">Meru</option>
                                                <option value="migori">Migori</option>
                                                <option value="marsabit">Marsabit</option>
                                                <option value="mombasa">Mombasa</option>
                                                <option value="muranga">Muranga</option>
                                                <option value="nairobi">Nairobi</option>
                                                <option value="nakuru">Nakuru</option>
                                                <option value="nandi">Nandi</option>
                                                <option value="narok">Narok</option>
                                                <option value="nyamira">Nyamira</option>
                                                <option value="nyandarua">Nyandarua</option>
                                                <option value="nyeri">Nyeri</option>
                                                <option value="samburu">Samburu</option>
                                                <option value="siaya">Siaya</option>
                                                <option value="taita taveta">Taita Taveta</option>
                                                <option value="tana river">Tana River</option>
                                                <option value="tharaka nithi">Tharaka Nithi</option>
                                                <option value="trans nzoia">Trans Nzoia</option>
                                                <option value="turkana">Turkana</option>
                                                <option value="uasin gishu">Uasin Gishu</option>
                                                <option value="vihiga">Vihiga</option>
                                                <option value="wajir">Wajir</option>
                                                <option value="pokot">West Pokot</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please provide county
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputrole4">Role</label>
                                            <select name="role" class="form-control" id="inputrole4">
                                                <option selected>{{ $user['role'] }}</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please provide role
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        @endif

                        @if (Auth::user()->role == 'Teller')
                            <form action="{{ route('user.updateUser') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $customer['id'] }}">

                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                        <label for="inputfname4">First Name</label>
                                        <input type="text" class="form-control" id="inputfname4" name="name" placeholder="Name" value="{{ $customer['name'] }}">
                                        <div class="col-md-6">
                                            <span class="text-danger ">@error('name'){{ $message }}@enderror</span>
                                        </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputemail4">Email</label>
                                            <input type="email" class="form-control" id="inputemail4" name="email" placeholder="Email" value="{{ $customer['email'] }}">
                                            <div class="col-md-6">
                                                <span class="text-danger ">@error('email'){{ $message }}@enderror</span>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputtel4">Telephone</label>
                                            <input type="text" class="form-control" id="inputtel4" name="telephone" placeholder="Telephone" value="{{ $customer['telephone'] }}">
                                            <div class="invalid-feedback">
                                                Please provide telephone number
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputcounty4">County</label>
                                            <select id="inputcounty4" class="form-control" name="county">
                                                <option selected>{{ $customer['county'] }}</option>
                                                <option value="baringo">Baringo</option>
                                                <option value="bomet">Bomet</option>
                                                <option value="bungoma">Bungoma</option>
                                                <option value="busia">Busia</option>
                                                <option value="elgeyo marakwet">Elgeyo Marakwet</option>
                                                <option value="embu">Embu</option>
                                                <option value="garissa">Garissa</option>
                                                <option value="homa bay">Homa Bay</option>
                                                <option value="isiolo">Isiolo</option>
                                                <option value="kajiado">Kajiado</option>
                                                <option value="kakamega">Kakamega</option>
                                                <option value="kericho">Kericho</option>
                                                <option value="kiambu">Kiambu</option>
                                                <option value="kilifi">Kilifi</option>
                                                <option value="kirinyaga">Kirinyaga</option>
                                                <option value="kisii">Kisii</option>
                                                <option value="kisumu">Kisumu</option>
                                                <option value="kitui">Kitui</option>
                                                <option value="kwale">Kwale</option>
                                                <option value="laikipia">Laikipia</option>
                                                <option value="lamu">Lamu</option>
                                                <option value="machakos">Machakos</option>
                                                <option value="makueni">Makueni</option>
                                                <option value="mandera">Mandera</option>
                                                <option value="meru">Meru</option>
                                                <option value="migori">Migori</option>
                                                <option value="marsabit">Marsabit</option>
                                                <option value="mombasa">Mombasa</option>
                                                <option value="muranga">Muranga</option>
                                                <option value="nairobi">Nairobi</option>
                                                <option value="nakuru">Nakuru</option>
                                                <option value="nandi">Nandi</option>
                                                <option value="narok">Narok</option>
                                                <option value="nyamira">Nyamira</option>
                                                <option value="nyandarua">Nyandarua</option>
                                                <option value="nyeri">Nyeri</option>
                                                <option value="samburu">Samburu</option>
                                                <option value="siaya">Siaya</option>
                                                <option value="taita taveta">Taita Taveta</option>
                                                <option value="tana river">Tana River</option>
                                                <option value="tharaka nithi">Tharaka Nithi</option>
                                                <option value="trans nzoia">Trans Nzoia</option>
                                                <option value="turkana">Turkana</option>
                                                <option value="uasin gishu">Uasin Gishu</option>
                                                <option value="vihiga">Vihiga</option>
                                                <option value="wajir">Wajir</option>
                                                <option value="pokot">West Pokot</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please provide county
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        @endif
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