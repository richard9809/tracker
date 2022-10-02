@extends('master')

@section('insider')

    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="col-md-8">
                <form action="">
                    
                </form>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="float: left">Issue Product</h4>
                        </div>

                        <form action="{{ route('user.issueProduct') }}" method="post">
                            @csrf
                        <div class="card-body">
                            <table class="table table-bordered table-left">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Barcode</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Deposit</th>
                                        <th>Amount</th>
                                        <th><a href="#" class="btn btn-sm btn-success add_more rounded-circle"><i class="fa fa-plus-circle"></i></a></th>
                                    </tr>
                                </thead>

                                <tbody class="issueProduct">
                                    
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Total <b class="total pull-right"> 0.00 </b></h4>
                        </div>
                        <div class="card-body">
                            <div class="panel">
                                <div class="row">
                                    <table class="table table-striped">
                                        <tr>
                                            <td>
                                                <label for="">Customer Name</label>
                                                <select name="customer_id" id="customer_id" class="form-control">
                                                    <option value="">Choose Customer</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }}</option>
                                                        @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <label for="">Teller Name</label>
                                                <select name="teller_id" id="teller_id" class="form-control">
                                                    <option hidden value="{{ Auth::user()->id }}">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>

                                    <td> Payment Method <br>

                                        <div class="form-check form-check-inline d-flex justify-content-around mt-1">
                                            <span class="radio-item">
                                                <input type="radio" name="payment_method" id="payment_method" class="true" value="Cash" checked>
                                                <label for="payment_methods"> <i class="fa fa-money text-success"></i> Cash </label>
                                            </span>
    
                                            <span class="radio-item">
                                                <input type="radio" name="payment_method" id="payment_method" class="true" value="Credit Card" checked>
                                                <label for="payment_methods"> <i class="fa fa-university text-danger"></i> Bank Transfer </label>
                                            </span>

                                            <span class="radio-item">
                                                <input type="radio" name="payment_method" id="payment_method" class="true" value="Mpesa" checked>
                                                <label for="payment_methods"> <i class="fa fa-credit-card text-success"></i> M-pesa </label>
                                            </span>
                                        </div>

                                    </td> <br>

                                    <td>
                                        Payment 
                                        <input type="number" name="paid_amount" id="paid_amount" class="form-control">
                                    </td>

                                    <td>
                                        Returning Change 
                                        <input type="number" readonly name="balance" id="balance" class="form-control">
                                    </td>

                                    <td>
                                        <button class="btn-primary btn-lg btn-block mt-3"> Save </button>
                                    </td>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            </div>
        </div>
    </div>

@endsection