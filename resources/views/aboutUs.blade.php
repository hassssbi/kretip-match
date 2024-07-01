@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row p-3 justify-content-between">
        <div class="col-5">
            <h2>About Us</h2>
            <p>
                A non-governmental organization serving Malaysian youth is called <strong>Kretip Malaya</strong>. The establishment of Kretip Malaya took place on January 20, 2021. This group is a club for young and innovative people. The terms "creative" and "tips" are combined in the name of this company in the Malaysian language, and Malaya alludes to our nation, Malaysia. The Kretip Malaya merchandise produced is one of the efforts to raise money to assist those in need since Kretip Malaya is a group that frequently engages in humanitarian activities to support everyone who is in need.
            </p>
        </div>
        <div class="col-5 my-auto">
            <img src="{{ asset('admin/dist/img/kretip-match-text.png')}}" alt="" class="w-100">
        </div>
    </div>
    <div class="row p-3 justify-content-between">
        <div class="col-4 my-auto">
            <img src="{{ asset('admin/dist/img/kretip-malaya-logo-wide.png')}}" alt="" style="width: 100%">
        </div>
        <div class="col-6">
            <h2>What We Do?</h2>
            <p>
                Since our inception, we have engaged in a wide range of events, all of which are based on the fact that our club is known as the Youth and Creative Club. The TikTok Challenge contest or campaign and it was one of the first things we ever did. and it's perfectly fitting given how frequently youngsters use TikTok apps these days. In addition, among many other youth programmes we run, we frequently engage in charitable work to help groups in need. such as flood-related Incident victims. and groups struggling during the Pandemic COVID 19, we provide necessities to the homeless, and provide aid during ramadan.
            </p>
        </div>
    </div>

    {{-- <div class="row justify-content-center">
        <div id="myCarousel" class="carousel slide carousel-fade w-75 " data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{ asset('admin/dist/img/photo1.png') }}" class="d-block w-100" alt="photo">
                <div class="carousel-caption d-none d-md-block">
                  <h5>First slide label</h5>
                  <p>Some representative placeholder content for the first slide.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{ asset('admin/dist/img/photo2.png') }}" class="d-block w-100" alt="photo">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content for the second slide.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{ asset('admin/dist/img/photo3.jpg') }}" class="d-block w-100" alt="photo">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Third slide label</h5>
                  <p>Some representative placeholder content for the third slide.</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div> --}}
</div>



@endsection
