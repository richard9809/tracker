@extends('master')

@section('insider')

    <div class="container-fluid">
        <div class="col-lg-12 mt-4">
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
                                    <tr>
                                        <td>1</td>

                                        <td>
                                            <select name="barcodes[]" id=" barcodes" class="form-control barcodes">
                                                <option value="">Select Item</option>
                                                @foreach ($products as $product)
                                                    <option data-price="{{ $product->price }}"
                                                         data-size="{{ $product->size }}" 
                                                         value="{{ $product->barcode }}">{{ $product->barcode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            <input readonly type="text" name="size[]" id="size[]" class="form-control size">
                                        </td>

                                        <td>
                                            <input readonly type="number" name="price[]" id="price[]" class="form-control price">
                                        </td>

                                        <td>
                                            <input type="number" name="deposit[]" id="deposit[]" class="form-control deposit">
                                        </td>

                                        <td>
                                            <input readonly type="number" name="total_amount[]" id="total_amount[]" class="form-control total_amount">
                                        </td>

                                        <td>
                                            <a href="#" class="btn btn-sm btn-danger rounded-circle"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
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

@endsection

@section('script')

    <script>
        $('.add_more').on('click', function(){
            var product = $('.barcodes').html();
            var numberofrow = ($('.issueProduct tr').length - 0) + 1;
            var tr = '<tr><td class"no"">' + numberofrow + '</td>' +
                     '<td><select name="barcodes[]" class="form-control barcodes">' + product + '</select></td>' +
                     '<td> <input type="text" name="size[]" id="size[]" class="form-control size"> </td>' +
                     '<td> <input type="number" name="price[]" id="price[]" class="form-control price"> </td>' +
                     '<td> <input type="number" name="deposit[]" id="deposit[]" class="form-control deposit"> </td>' +
                     '<td> <input type="number" name="total_amount[]" id="total_amount[]" class="form-control total_amount"> </td>' +
                     '<td> <a class="btn btn-sm btn-danger delete rounded-circle"><i class="fa fa-times"></i> </a></td>'
                     $('.issueProduct').append(tr);
        });

        // Delete row
        $('.issueProduct').delegate('.delete', 'click', function(){
            $(this).parent().parent().remove();
        });

        function TotalAmount(){
            var total = 0;
            $('.total_amount').each(function(i, e){
                var amount = $(this).val() - 0;
                total += amount;
            });

            $('.total').html(total);

        }

        $('.issueProduct').delegate('.barcodes', 'change', function(){
            var tr = $(this).parent().parent();
            var prc = tr.find('.barcodes option:selected').attr('data-price');
            tr.find('.price').val(prc);
            var size = tr.find('.barcodes option:selected').attr('data-size');
            tr.find('.size').val(size);

            var depo = tr.find('.deposit').val() - 0;
            var prc = tr.find('.price').val() - 0;
            var total_amount = prc + depo;
            tr.find('.total_amount').val(total_amount);
            TotalAmount();
        });

        $('.issueProduct').delegate('.deposit', 'keyup', function(){
            var tr = $(this).parent().parent();
            var depo = tr.find('.deposit').val() - 0;
            var prc = tr.find('.price').val() - 0;
            var total_amount = prc + depo;
            tr.find('.total_amount').val(total_amount);
            TotalAmount();
        });

        $('#paid_amount').keyup(function() {
            var total = $('.total').html();
            var paid_amount = $(this).val();
            var tot = paid_amount - total;
            $('#balance').val(tot).toFixed(2);
        });

    </script>
@endsection