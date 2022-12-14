@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Mis imagenes favoritas</h1>
                <hr>
                @foreach ($likeList as $like)
                    @include('includes.image', ['image' => $like->image])
                @endforeach

                <div class="clearfix"></div>
                {{ $likeList->links() }}

            </div>
        </div>
    </div>
@endsection
