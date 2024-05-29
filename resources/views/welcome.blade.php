@extends('layouts.app')
@section('content')
<div class="container py-5 my-5">
    <div class="d-flex justify-content-center py-4">
        <div class="col-md-8 py-1">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Walk through the World with Us.</h1>
                    <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci dolores iusto deleniti velit in. Quos voluptate sunt sint commodi consequuntur perspiciatis numquam dicta laboriosam voluptas rem laudantium, ullam itaque pariatur at, ipsum reprehenderit cupiditate. Assumenda voluptatum harum voluptatibus voluptates quisquam repellendus, natus consectetur sunt impedit laudantium dolor. Praesentium alias asperiores, culpa ab vero omnis sapiente suscipit quo pariatur, aliquid ducimus delectus necessitatibus eligendi sequi eius laborum ex ratione, aspernatur minus nisi rem nobis. Dolores reiciendis repudiandae ipsam nemo? Ab, architecto.</p>
                    <div class="d-flex justify-content-center">
                        <a href="{{ url('/about-us')}}" class="btn btn-warning"><strong>Get to know us!</strong></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
