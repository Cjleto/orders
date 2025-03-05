@extends('layouts.app')

@section('content')


            <div class="container mx-auto mt-10">
                <div class="row">
                    <!-- Card con icona -->
                    <div class="col-md-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3">
                                    <i class="bi bi-cart fs-1"></i>
                                </div>
                                <div>
                                    <h5 class="card-title">Nuovi Ordini</h5>
                                    <p class="card-text fs-4">150</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card con barra di progresso -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Performance</h5>
                                <p class="card-text">Vendite Mensili</p>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card con grafico -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Statistiche</h5>
                                <canvas id="chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

@endsection
