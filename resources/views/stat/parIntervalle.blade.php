@extends('default')
{{-- <script src="{{ asset('https://cdn.jsdelivr.net/npm/chart.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
    <h1>Regroupement des données par annéee et par sexe</h1>
    <div class="mx-auto">
        <div class="container">
            <div class="card mb-3" id="simple" style="display: block">
                <div class="card-header">
                    <i class="fa fa-area-chart"></i> Variation du nombre de demandes suivant les sexe et d'après l'année 2019.
                </div>
                <div class="card-body">
                    <canvas id="myAreaChart" width="786" height="235" class="chartjs-render-monitor" style="display: block; width: 786px; height: 235px;"></canvas>
                </div>
                <div class="card-footer small text-muted">
                    {{-- Mis à jour {{$last->dateDem->locale('fr')->calendar()}} --}}
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto">
        <div class="container">
            <div class="card mb-3" id="simple" style="display: block">
                <div class="card-header">
                    <i class="fa fa-area-chart"></i> Répartition des employés par service suivant leur sexe
                </div>
                <div class="card-body">
                    <canvas id="myAreaChart2" width="786" height="235" class="chartjs-render-monitor" style="display: block; width: 786px; height: 235px;"></canvas>
                </div>
                <div class="card-footer small text-muted">
                    {{-- Mis à jour {{$last->dateDem->locale('fr')->calendar()}} --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        var cData = JSON.parse('<?php echo $data['final']; ?>');
        var ctx = $('#myAreaChart');
        const labels = cData.labels;
        const data = {
            labels : labels,
            datasets : [
                {
                    label: 'Les demandes des hommes',
                    // data : [10,20,12,15,75,45,22,55,2,21,16,54], 
                    data : cData.M, 
                    backgroundColor: 'rgb(255,255,255)',
                    borderColor: 'rgb(146, 192, 208)',
                    // fill: true,
                },
                {
                    label: 'Les demandes des femmes',
                    data : cData.F,   
                    backgroundColor: 'rgb(255,0,0)',
                    borderColor: 'rgb(146, 192, 17)',
                    // fill: true,
                }
            ]
        };
        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                plugins:{ 
                    title: {
                        text : "Variation du nombre de demandes suivant les services"
                    }
                },
                elements:{
                    point:{
                        radius : 5
                    }
                }
            }
        });
    </script>
    <script>
        var cData = JSON.parse('<?php echo $data['final']; ?>');
        var ctx = $('#myAreaChart2');
        const labels2 = cData.service;
        const data2 = {
            labels : labels2,
            datasets : [
                {
                    label: 'Les hommes',
                    // data : [10,20,12,15,75,45,22,55,2,21,16,54], 
                    data : cData.m, 
                    backgroundColor: 'rgb(255,255,255)',
                    borderColor: 'rgb(146, 192, 208)',
                    // fill: true,
                },
                {
                    label: 'Les femmes',
                    data : cData.f,   
                    backgroundColor: 'rgb(255,0,0)',
                    borderColor: 'rgb(146, 192, 17)',
                    // fill: true,
                }
            ]
        };
        var myChart = new Chart(ctx, {
            type: 'line',
            data: data2,
            options: {
                plugins:{ 
                    title: {
                        text : "Variation du nombre de demandes suivant les services"
                    }
                },
                elements:{
                    point:{
                        radius : 5
                    }
                }
            }
        });
    </script>
@endsection