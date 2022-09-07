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
            </div>
        </section>

        


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
    </script>
@endsection