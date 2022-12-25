@extends('layouts.app')
@section('content')
    <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-12 justify-content-center dashboard m-5">
                    {{-- <h1> Welcome {{ Auth::user()->first_name . '  ' . Auth::user()->last_name . ' ' }}to
                        {{ config('app.name') }}
                    </h1> --}}
                </div>
                <div class="row d-flex justify-content-center">
                    @if (Auth::user()->role == 1 && Auth::user()->company_id == null)
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">

                                <div class="inner">
                                    <h3 class="d-flex justify-content-center">
                                        {{ $users }}
                                    </h3>
                                    <p>
                                        Manage Users
                                    </p>
                                </div>

                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('manage-userAdmin') }}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    @else
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">

                                <div class="inner">
                                    <h3 class="d-flex justify-content-center">
                                        {{ $company_users }}
                                    </h3>
                                    <p>
                                        Manage Users
                                    </p>
                                </div>

                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('manage-user') }}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    @endif
                    @can('manage-client')
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">

                                <div class="inner">
                                    <h3 class="d-flex justify-content-center">
                                        {{ $clients }}
                                    </h3>
                                    <p>
                                        Manage Clients
                                    </p>
                                </div>

                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('client-list') }}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    @endcan
                    @can('manage-client')
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">

                                <div class="inner">
                                    <h3 class="d-flex justify-content-center">
                                        {{ $invoice }}
                                    </h3>
                                    <p>
                                        Invoices
                                    </p>
                                </div>

                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('all-invoices') }}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    @endcan
                    @can('manage-company')
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">

                                <div class="inner">
                                    <h3 class="d-flex justify-content-center">
                                        {{ $companies }}
                                    </h3>
                                    <p>
                                        Manage companies
                                    </p>
                                </div>

                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('company-list') }}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    @endcan
                    <div class="col-md-10">
                        @can('manage-client')
                            <canvas id="myChart" height="100px"></canvas>
                        @endcan
                    </div>
                </div>

            </div>

        </div><!-- /.container-fluid -->

    </section>
    <!--  </div> -->
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        var labels = {{ Js::from($labels) }};
        var users = {{ Js::from($dataChart) }};

        const data = {
            labels: labels,
            datasets: [{
                label: 'My Clients dataset',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: users,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
@endsection
