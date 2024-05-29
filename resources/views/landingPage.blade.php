@extends('layouts.app')
@section('content')
<div class="container py-5 my-5">
    <div class="d-flex justify-content-center py-4">
        <div class="col-md-8 py-1">
            <div class="card text-center">
                <div class="card-body">
                    <h1>Walk through the World with Us.</h1>
                    <p>A non-governmental organisation serving Malaysian youth is called Kretip Malaya. The establishment of Kretip Malaya took place on January 20, 2021. This group is a club for young and innovative people. The terms "creative" and "tips" are combined in the name of this company in the Bahasa Malaysian language, and Malaya alludes to our nation, Malaysia. The Kretip Malaya merchandise produced is one of the efforts to raise money to assist those in need since Kretip Malaya is a group that frequently engages in humanitarian activities to support everyone who is in need.</p>
                    <div>
                        <a href="{{ url('/about-us')}}" class="btn btn-warning"><strong>Get to know us!</strong></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
