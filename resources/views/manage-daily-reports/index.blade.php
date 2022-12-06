@extends('layouts.app')
@section('content')
    <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-12 justify-content-center dashboard m-5">
                    <h1> Check your daily report over here
                    </h1>
                </div>
                <div class="row d-flex justify-content-center">
                    @if (Auth::user()->role == 1 && Auth::user()->company_id == null)
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">

                                <div class="inner">
                                    <h3 class="d-flex justify-content-center">
                                        9
                                    </h3>
                                    <p>
                                        Group notes
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
                                        {{ $daily }}
                                    </h3>
                                    <p>
                                        Client Daily Report
                                    </p>
                                </div>

                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('today-client') }}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    @endif
                    @if (Auth::user()->role == 1 && Auth::user()->company_id != null)
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">

                                <div class="inner">
                                    <h3 class="d-flex justify-content-center">
                                        {{ $weekly }}
                                    </h3>
                                    <p>
                                        Clients Weekly report
                                    </p>
                                </div>

                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('weekly-client') }}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    @endif
                    @if (Auth::user()->role == 1 && Auth::user()->company_id != null)
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">

                                <div class="inner">
                                    <h3 class="d-flex justify-content-center">
                                        {{ $monthly }}
                                    </h3>
                                    <p>
                                        Client Monthly report
                                    </p>
                                </div>

                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('monthly-client', ['id' => $data->comp_id, 'name' => $data->company_name]) }}"
                                    class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    @endif
                    @if (Auth::user()->role == 1 && Auth::user()->company_id == null)
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">

                                <div class="inner">
                                    <h3 class="d-flex justify-content-center">

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
                    @endif

                </div>

            </div>

        </div><!-- /.container-fluid -->

    </section>
    <!--  </div> -->
@endsection
