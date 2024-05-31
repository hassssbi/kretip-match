@extends('layouts.template')
@section('content')

<div class="wrapper">
    <div class="container">
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
            {{-- <div class="col-12">
                <form action="{{ route('admins.registrationsByYear', ['year' => $year]) }}" method="get" class="mb-4">
                    <div class="form-group row">
                        <label for="year" class="col-sm-2 col-form-label">Select Year</label>
                        <div class="col-sm-10">
                            <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                                @for ($y = 2020; $y <= Carbon\Carbon::now()->year; $y++)
                                    <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </form>
            </div> --}}

            <div class="col-6">
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

            <div class="col-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="title pb-2">
                            <h4>New Members</h4>
                        </div>
                        @foreach($newMembers as $member)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="text-lg text-bold mb-0">{{ $member->name }}<br><span class="text-sm">({{ $member->role->name }})</span></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
const xValues = ['January','February','March','April','May','June','July','August','September','October','November','December'];
const yValues = [0,1,1,2,2,2,4,4,4,4,5,5];
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
