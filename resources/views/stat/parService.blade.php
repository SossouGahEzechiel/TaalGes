<script src="{{ asset('https://cdn.jsdelivr.net/npm/chart.js') }}"></script>
@extends('default')
@section('content')
<h2>Page des statistiques par service</h2>
    <div class="mx-auto">
        <div class="container">
            <div class="card mb-3" id="simple" >
                <div class="card-header">
                    <i class="fa fa-area-chart"></i> Statistiques par services
                </div>
                <div class="card-body">
                    <canvas id="myAreaChart" width="786" height="235" class="chartjs-render-monitor" style="width: 786px; height: 235px;"></canvas>
                </div>
                    <div class="card-footer small text-muted">Mis à jour {{$last->dateDem->locale('fr')->calendar()}}</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var cData = JSON.parse('<?php echo  $data['final']; ?>');
        var ctx = $("#myAreaChart");
        const labels = cData.service

        const data = {
            labels: labels,
            datasets: [{
                label: 'nombre de demandes total',    
                backgroundColor: 'rgb(255,255,255)',
                borderColor: 'rgb(146, 192, 208)',
                data: cData.nb,
                fill: false,
            },{
                label: 'nombre de demandes en attente',    
                backgroundColor: 'rgb(255,255,255)',
                borderColor: 'rgb(255, 128, 0)',
                data: cData.null,
                fill: false,
            },{
                label: 'nombre de demandes accordées',    
                backgroundColor: 'rgb(255,255,255)',
                borderColor: 'rgb(76, 153, 0)',
                data: cData.acc,
                fill: false,
            },{
                label: 'nombre de demandes rejetées',    
                backgroundColor: 'rgb(255,255,255)',
                borderColor: 'rgb(255, 0, 0)',
                data: cData.ref,
                fill: false,
            }]
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
                        radius : 3
                    }
                }
            }
        });
    </script>
@endsection 