    <script src="{{ asset('https://cdn.jsdelivr.net/npm/chart.js') }}"></script>
@extends('default')
@section('content')
<h2>Page des statistiques par service</h2>
    
    {{-- @dd($data) --}}
    <div class="btn-group mb-3 ml4 col-12 mx-auto" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-primary mr-2" onclick="display('simple')">Demande par service</button>
        <button type="button" class="btn btn-warning mr-2" onclick="display('coming')">Demande en attente</button>
        <button type="button" class="btn btn-success mr-2" onclick="display('done')">Demande en Accordées</button>
        <button type="button" class="btn btn-danger mr-2" onclick="display('refused')">Demande en non-accordées</button>
    </div>

    <div class="mx-auto">
        <div class="container">
            <div class="card mb-3" id="simple" style="display: none">
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
        <div class="container">
            <div class="card mb-3" id="coming" style="display: none">
                <div class="card-header">
                    <i class="fa fa-area-chart"></i> Variation du nombre de demandes en attente suivant les services
                </div>
                <div class="card-body">
                    <canvas id="myAreaChart2" width="786" height="235" class="chartjs-render-monitor" style="display: block; width: 786px; height: 235px;"></canvas>
                </div>
                    <div class="card-footer small text-muted">Mis à jour {{$last->dateDem->locale('fr')->calendar()}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="mr-0">
        <div class="container">
            <div class="container">
                <div class="card mb-3" id="done" style="display: none">
                    <div class="card-header" >
                        <i class="fa fa-area-chart"></i> Variation du nombre de demandes accordées suivant les services
                    </div>
                    <div class="card-body">
                        <canvas id="myAreaChart3" width="786" height="235" class="chartjs-render-monitor" style="display: block; width: 786px; height: 235px;"></canvas>
                    </div>
                        <div class="card-footer small text-muted">Mis à jour {{$last->dateDem->locale('fr')->calendar()}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card mb-3" id="refused" style="display: none">
                <div class="card-header">
                    <i class="fa fa-area-chart"></i> Variation du nombre de demandes non-accordée suivant les services
                </div>
                <div class="card-body">
                    <canvas id="myAreaChart4" width="786" height="235" class="chartjs-render-monitor" style="display: block; width: 786px; height: 235px;"></canvas>
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
                label: 'nombre de demandes',    
                backgroundColor: 'rgb(255,255,255)',
                borderColor: 'rgb(146, 192, 208)',
                data: cData.nb,
                fill: true,
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

    <script>
        function display(id){
            var chart = document.getElementById(id);
            if (chart.style.display == "none")
                return chart.style.display = "block";
            else return chart.style.display = "none";
        }
    </script>

    <script>
        var cData2 = JSON.parse('<?php echo  $data2['final']; ?>');
        var ctx2 = $("#myAreaChart2");
        const labels2 = cData2.service

        const data2 = {
            labels: labels2,
            datasets: [{
                label: 'nombre de demandes',    
                backgroundColor: 'rgb(255,255,255)',
                borderColor: 'rgb(255, 128, 0)',
                data: cData2.nb,
                fill: true,
            }]
        };

        var myChart2 = new Chart(ctx2, {
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

    <script>
        var cData3 = JSON.parse('<?php echo  $data3['final']; ?>');
        var ctx3 = $("#myAreaChart3");
        const labels3 = cData3.service

        const data3 = {
            labels: labels3,
            datasets: [{
                label: 'nombre de demandes',    
                backgroundColor: 'rgb(255,255,255)',
                borderColor: 'rgb(76, 153, 0)',
                data: cData3.nb,
                fill: true,
            }]
        };

        var myChart = new Chart(ctx3, {
            type: 'line',
            data: data3,
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
        var cData = JSON.parse('<?php echo  $data4['final']; ?>');
        var ctx4 = $("#myAreaChart4");
        const labels4 = cData4.service

        const data4 = {
            labels: labels4,
            datasets: [{
                label: 'nombre de demandes',    
                backgroundColor: 'rgb(255,255,255)',
                borderColor: 'rgb(255, 0, 0)',
                data: cData4.nb,
                fill: true,
            }]
        };

        var myChart = new Chart(ctx4, {
            type: 'line',
            data: data4,
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