@extends('layouts.expositor.app')


@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ route('home-expositor')}}">Inicio</a>
           
    </ul>
</div>
<div class="row" style="margin-top: 10px">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ route('sponsor-events')}}">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="1349">1</span>
                                        </div>
                                        <div class="desc"> Mis Eventos </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                    <div class="visual">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="12,5">14</span> </div>
                                        <div class="desc"> Usuarios Registrados a los eventos </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                    <div class="visual">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="549">15</span>
                                        </div>
                                        <div class="desc"> Productos </div>
                                    </div>
                                </a>
                            </div>
                           
@endsection