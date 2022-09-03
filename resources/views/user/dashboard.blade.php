@extends('master')

@section('insider')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="m-0" id="greetings"></h2>
                    </div>
                </div>
            </div>
        </div>

        <section class="content mt-2">
            <div class="container-fluid">
                <div class="row ">
                    <div class="card bg-info col-md-3 col-6">
                        <div class="small-box bg-info d-flex justify-content-between mt-2">
                            <div class="inner text-white">
                                <h3 class="font-weight-bold">150</h3>
                                <p class="font-weight-normal">No. of Bottles Issued</p>
                            </div>
                            <div class="icon " style="font-size: 3em;">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>    
                        <div class="footer text-center mb-1">
                            <a href="#" class="small-box-footer" style="font-size: 1.2em; color: black;">More info <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>                    
                    </div>

                    <div class="card bg-success col-lg-3 col-6">
                        <div class="small-box bg-success d-flex justify-content-between mt-2">
                            <div class="inner text-white">
                                <h3 class="font-weight-bold">120</h3>
                                <p class="font-weight-normal">No. of Bottles Returned</p>
                            </div>
                            <div class="icon " style="font-size: 3em;">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>    
                        <div class="footer text-center mb-1">
                            <a href="#" class="small-box-footer" style="font-size: 1.2em; color: black;">More info <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>                    
                    </div>

                    <div class="card bg-warning col-lg-3 col-6">
                        <div class="small-box bg-warning d-flex justify-content-between mt-2">
                            <div class="inner text-white">
                                <h3 class="font-weight-bold">Shs. 2000</h3>
                                <p class="font-weight-normal">Deposits</p>
                            </div>
                            <div class="icon " style="font-size: 3em;">
                                <i class="ion ion-person-add"></i>
                            </div>
                        </div>    
                        <div class="footer text-center mb-1">
                            <a href="#" class="small-box-footer" style="font-size: 1.2em; color: black;">More info <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>                    
                    </div>

                    <div class="card bg-danger col-lg-3 col-6">
                        <div class="small-box bg-danger d-flex justify-content-between mt-2">
                            <div class="inner text-white">
                                <h3 class="font-weight-bold">Shs. 1500</h3>
                                <p class="font-weight-normal">Credits</p>
                            </div>
                            <div class="icon " style="font-size: 3em;">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                        </div>    
                        <div class="footer text-center mb-1">
                            <a href="#" class="small-box-footer" style="font-size: 1.2em; color: black;">More info <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>                    
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection

@section('script')
    <script>
        var today = new Date()
        var curHr = today.getHours()

        if(curHr >= 0 && curHr < 9){
            document.getElementById("greetings").innerHTML = 'Good morning, {{ Auth::user()->fname }}';
        }else if(curHr >= 10 && curHr <= 11){
            document.getElementById("greetings").innerHTML = 'Good day, {{ Auth::user()->fname }} ';
        }else if(curHr >= 12 && curHr <= 15){
            document.getElementById("greetings").innerHTML = 'Good afternoon, {{ Auth::user()->fname }}';
        }else{
            document.getElementById("greetings").innerHTML = 'Good evening, {{ Auth::user()->fname }} ';
        }
    </script>
@endsection