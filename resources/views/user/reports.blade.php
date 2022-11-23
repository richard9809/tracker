@extends('master')

@section('insider')

    <section class="content">
        <div class="container-fluid">
            <div class="row mr-2">

                @if (Auth::user()->role == 'Admin')
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header text-center">
                                <h3 class="card-title">Users Reports</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped display nowrap" id="users">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>County</th>
                                        </tr>
                                    </thead>
        
                                    <tbody>
                                    </tbody>
        
                                    <tfoot>
                                        <tr>
        
                                            <td>
                                                <select data-column="3" class="form-control filter-select">
                                                    <option value="">Select County...</option>
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
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>                    
                @endif

                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header text-center">
                            <h3 class="card-title">Issue Reports</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped display nowrap" id="issueReports">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Deposit</th>
                                        <th>Customer</th>
                                        <th>Issued By</th>
                                        <th>Issue Date</th>
                                    </tr>
                                </thead>

                                <tbody></tbody>

                                <tfoot>
                                    
                                </tfoot>
                            </table>

                        </div>
                    </div>

                </div>

                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header text-center">
                            <h3 class="card-title">Issue Reports</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped display nowrap" id="retrunReports">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Amount Returned</th>
                                        <th>Customer</th>
                                        <th>Returned By</th>
                                        <th>Return Date</th>
                                    </tr>
                                </thead>

                                <tbody></tbody>

                                <tfoot>
                                    
                                </tfoot>
                            </table>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection

@section('script')

    <script>
        $(document).ready(function (){
            var table = $('#users').DataTable({
                'processing': true,
                'serverSide': true,
                'ajax': "{{ route('user.reports') }}",
                'columns': [
                    {'data': 'name'},
                    {'data': 'email'},
                    {'data': 'telephone'},
                    {'data': 'county'}
                ],
                "paging": true,
                "orderClasses": false,
                dom: 'Bfrtip',
                "responsive": true, "lengthChange": false, "autoWidth": false,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            
            $('.filter-select').change(function(){
                table.column( $(this).data('column') )
                .search( $(this).val() )
                .draw();
            });

        });

        $(document).ready(function (){
            var table = $('#issueReports').DataTable({
                'processing': true,
                'ajax': "{{ route('user.issueReports') }}",
                'columns': [
                    {'data': 'barcode'},
                    {'data': 'deposit'},
                    {'data': 'Customer'},
                    {'data': 'Teller'},
                    {'data': 'issueDate'}
                ],
                "paging": true,
                "orderClasses": false,
                dom: 'Bfrtip',
                "responsive": true, "lengthChange": false, "autoWidth": false,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            

        });

        $(document).ready(function (){
            var table = $('#retrunReports').DataTable({
                'processing': true,
                'ajax': "{{ route('user.returnReports') }}",
                'columns': [
                    {'data': 'Barcode'},
                    {'data': 'AmountReturned'},
                    {'data': 'Customer'},
                    {'data': 'Teller'},
                    {'data': 'returnDate'}
                ],
                "paging": true,
                "orderClasses": false,
                dom: 'Bfrtip',
                "responsive": true, "lengthChange": false, "autoWidth": false,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            

        });
      

    </script>

@endsection