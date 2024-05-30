@extends('layouts.template')
@section('content')
<style>
    .bg-kretip-yellow {
        background-color: #e9dcad;
    }

    .bg-light-gray {
        background-color: #d1cdcd;
    }

    a.btn.btn-link:hover {
        border-bottom: 1px solid black;
        transition: 2ms all ease;
    }
</style>
<div class="wrapper">
    <div class="container">
        {{-- <div class="card bg-kretip-yellow">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="card bg-light-gray text-center h-100">
                            <div class="card-body">
                                <div class="title pb-2">
                                    <h3>New Members</h3>
                                </div>
                                <div class="new-member shadow card">
                                    <div class="card-body">
                                        Volunteer
                                    </div>
                                </div>
                                <div class="new-member shadow card">
                                    <div class="card-body">
                                        Volunteer
                                    </div>
                                </div>
                                <div class="new-member shadow card">
                                    <div class="card-body">
                                        Volunteer
                                    </div>
                                </div>
                                <div class="new-member shadow card">
                                    <div class="card-body">
                                        Volunteer
                                    </div>
                                </div>
                                <a href="#" class="btn btn-link mt-4 text-black text-bold">See All Members</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-light-gray text-center">
                            <div class="card-body p-5">
                                There were $count new volunteers registered in the past week!
                            </div>
                        </div>
                        <div class="card bg-light-gray text-center mb-0">
                            <div class="card-body">
                                <div class="title pb-2">
                                    <h3>Current Admins</h3>
                                </div>
                                <div class="admin shadow card">
                                    <div class="card-body">
                                        Admin
                                    </div>
                                </div>
                                <div class="admin shadow card">
                                    <div class="card-body">
                                        Admin
                                    </div>
                                </div>
                                <div class="admin shadow card">
                                    <div class="card-body">
                                        Admin
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row justify-content-center">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $vcount }}</h3>

                        <h5>Volunteers</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $mcount }}</h3>

                        <h5>Moderators</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-tie"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $acount }}</h3>

                        <h5>Admins</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-secret"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="title pb-2">
                            <h4>Number of Registrations</h4>
                        </div>
                        <div class="chart">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="title pb-2">
                            <h4>Number of X</h4>
                        </div>
                        <div class="chart">

                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
const xValues = ['January','February','March','April','May','June','July','August','September','October','November','December'];
const yValues = [1,1,1,1,2,2,2,2,3,3,3,5];
const myChart = new Chart("myChart", {
    type: "line",
    data: {
        labels: xValues,
        datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(0,0,255,1.0)",
            borderColor: "rgba(0,0,255,0.1)",
            data: yValues
        }],
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: "Number of Registrations",
                padding: {
                    top: 10,
                    bottom: 30,
                },
            },
        },
        legend: {
            display: false,
        },
        scales: {
            yAxes: [{
                ticks: {
                    stepSize: 1,
                    min: 0,
                },
                gridLines: {
                    // display: false,
                },
            }],
            xAxes: [{
                gridLines: {
                    display: false,
                }
            }],
        },
    },
});
</script>
@endsection
