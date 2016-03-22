@extends('layout')

@section('content')

    <div class="row">

        <div class="col-lg-3">



            <h1>{{ $flyer->street }}</h1>
            <h2>${!! number_format($flyer->price) !!}</h2>

            <hr>
            <div class="description">{!! nl2br($flyer->description) !!}
            </div>

        </div>

        <div class="col-md-9">

            @foreach( $flyer->photos as $photo )
            
                <img src="/{{ $photo->photo_path }}" alt="">
            
            @endforeach
            

        <div>

    </div>

    <form action="/{{ $flyer->zip }}/{{ $flyer->street }}/photos" method="POST" class="dropzone">

    {{ csrf_field() }}

    </form>



@stop


@section('scripts.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>

@stop