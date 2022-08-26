@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        Editar mi imagen
                        <div class="card-body">

                            <form action="{{ route('image.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="image_id" value="{{ $image->id }}">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-md-right" for="image_path">IMAGEN</label>
                                    <div class="col-md-7">
                                        @if ($image->user->image)
                                            <div class="container-avatar">
                                                <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" class="avatar">
                                            </div>
                                        @endif
                                        <input id="image_path" type="file" name="image_path"
                                            class="form-control {{ $errors->has('image_path') ? 'is-invalid' : '' }}">
                                        @foreach ($errors->all() as $error)
                                            <span class="invalid-feedback">
                                                <br><strong>{{ $error }} </strong>
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-md-right"
                                        for="description">DESCRIPCION</label>
                                    <div class="col-md-7">
                                        <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                            required>{{ $image->description }}</textarea>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-3">
                                        <input type="submit" class="btn btn-primary" value="Editar imagen">

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
