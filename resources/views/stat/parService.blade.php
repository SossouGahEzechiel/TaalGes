@extends('default')
@section('content')
{{-- <h2>Selectionnez un intervalle</h2> --}}

    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Variation du nombre de demandes suivant les services
            </div>
            <div class="card-body">
                <canvas id="myAreaChart" width="786" height="235" class="chartjs-render-monitor" style="display: block; width: 786px; height: 235px;"></canvas>
            </div>
                <div class="card-footer small text-muted">Mis à jour {{$last->dateDem->locale('fr')->calendar()}}</div>
            </div>
        </div>
    </div>

    <script src="{{ asset('https://cdn.jsdelivr.net/npm/chart.js') }}"></script>

    <script>
        var cData = JSON.parse('<?php echo  $data['final']; ?>');
        var ctx = $("#myAreaChart");
        const labels = cData.service

        const data = {
            labels: labels,
            datasets: [{
                label: 'nombre de demandes',    
                backgroundColor: 'rgb(255,255,255)',
                borderColor: 'rgb(146, 192, 208)',
                data: cData.nb,
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
                        radius : 5
                    }
                }
            }
        });
    </script>
@endsection 