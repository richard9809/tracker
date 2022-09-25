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

        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner text-white">
                                <h3 class="font-weight-bold">{{ $issued }}</h3>
                                <p class="font-weight-normal">No. of Bottles Issued</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner text-white">
                                <h3 class="">{{ $returns }}</h3>
                                <p class="">No. of Bottles Returned</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner text-white">
                                <h3 class="font-weight-bold">Shs. {{ $deposits }}</h3>
                                <p class="font-weight-normal">Deposits</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner text-white">
                                <h3 class="font-weight-bold">Shs. {{ $credits }}</h3>
                                <p class="font-weight-normal">Credits</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <!-- Charts -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h2 class="card-title">Charts</h2>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                      <li class="nav-item">
                                        <a class="nav-link active" id="sales" href="#sales-chart" data-toggle="tab">Sales</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="bottles" href="#bottles-chart" data-toggle="tab">Bottles</a>
                                      </li>
                                    </ul>
                                  </div>
                            </div>

                            <div class="card-body">
                                <div class="position-relative" id="barChart">
                                    {!! $chart->container() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Area & Doughnut Chart</h3>
                            </div>
                            <div class="card-body">
                                <div class="position-relative">
                                    {!! $Doughnut->container() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="below-chart">
            {!! $chart->script() !!}
            {!! $Doughnut->script() !!}
        </div>

    

    </div>

@endsection

@section('script')
    <script>
        var today = new Date()
        var curHr = today.getHours()

        if(curHr >= 0 && curHr <= 9){
            document.getElementById("greetings").innerHTML = 'Good morning, {{ Auth::user()->fname }}';
        }else if(curHr >= 10 && curHr <= 11){
            document.getElementById("greetings").innerHTML = 'Good day, {{ Auth::user()->fname }} ';
        }else if(curHr >= 12 && curHr <= 15){
            document.getElementById("greetings").innerHTML = 'Good afternoon, {{ Auth::user()->fname }}';
        }else{
            document.getElementById("greetings").innerHTML = 'Good evening, {{ Auth::user()->fname }} ';
        }

        const chartContainer = document.querySelector('#barChart');
        const chartScript = document.querySelector('#below-chart');

        const btnBottles = document.querySelector('#bottles');
        const btnSales = document.querySelector('#sales');


    </script>
@endsection