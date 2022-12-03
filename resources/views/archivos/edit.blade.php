@extends('layouts.app')
@section('title', 'Áreas')

@section('content')
<!-- General Container -->
<div class="container-fluid p-0">
    <!-- Form Container -->
    <div class="container-fluid">
        <div class="row justify-content-center">

            <!-- Container Slogan -->
            <div class="col-12 bg-primario rounded-top mb-3">
                <div class="col-12 py-4">
                    <h1 class="text-white fw-bold text-uppercase text-center fs-4 mb-2">Agregar archivos</h1>
                    <p class="text-white text-center fs-6 fw-light"></p>
                </div>
            </div>
            <!-- Container Slogan -->

            <!-- Form -->
            @include('layouts.partials.alerts')
            <form action="{{ route('archivos.update',$consulta) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Hide Section Button -->
                <div class="row justify-content-center">
                    <button id="btn-general-information" class="col-12 col-lg-10 border-0 text-white btn btn-primary mt-3 mb-1">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-8 text-start">
                                <span class="w-100">Información General</span>
                            </div>
                            <div class="col-2 text-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </div>
                        </div>
                    </button>
                </div>
                <!-- Hide Section Button End -->

                <!-- Personal Information Section -->
                <br>
                <section id="general-information" class="col-12 col-lg-12" >
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-10">

                            <!-- Input Text -->
                            <div class="form-floating my-2">
                                <input
                                    @class(['form-control'=> !$errors->first('matricula'), 'form-control is-invalid' => $errors->first('matricula')])
                                    autocomplete="off"
                                    autofocus="true"
                                    type="text"
                                    value="{{$consulta->matricula}}"
                                    @disabled(true)
                                    name="matricula" {{-- <-- Nombre del Campo --}}
                                    placeholder="input-text"
                                    id="input-text"
                                    maxlength="10"
                                    required>
                                <label for="input-text">Matricula del docente</label>

                                @if($errors->first('matricula'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('matricula') }}</i>
                                </div>
                                @endif

                            </div>
                            <div class="form-floating my-2">
                                <input
                                    @class(['form-control'=> !$errors->first('nombre'), 'form-control is-invalid' => $errors->first('nombre')])
                                    autocomplete="off"
                                    type="text"
                                    value="{{$consulta->name1}}"
                                    name="nombre" {{-- <-- Nombre del Campo --}}
                                    placeholder="input-text"
                                    id="input-text"
                                    required>
                                <label for="input-text">Nombre del archivo</label>

                                @if($errors->first('nombre'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('nombre') }}</i>
                                </div>
                                @endif

                            </div>
                            <div class="form-floating my-2">
                                <a href="{{$consulta->ruta}}">{{$consulta->name1}}</a>
                            </div>
                            <!-- Input Text End -->
                            <div class="form-floating my-2">
                                <input
                                    @class(['form-control'=> !$errors->first('ruta'), 'form-control is-invalid' => $errors->first('ruta')])
                                    autocomplete="off"
                                    type="file"
                                    value="{{ old( 'ruta' ) }}"
                                    name="ruta" {{-- <-- Nombre del Campo --}}
                                    placeholder=""
                                    id="input-text"
                                    required>
                                <label for="input-text"></label>

                                @if($errors->first('ruta'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('ruta') }}</i>
                                </div>
                                @endif

                            </div>
                            <!-- Input Select -->

                            <!-- Input Select End -->

                            <!-- Input Radios -->

                            <!-- Input Radios End -->

                            {{-- Input TextArea --}}

                            {{-- Input TextArea End --}}
                        </div>
                    </div>
                </section>
                <!-- Personal Information Section End -->
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-3">
                        <button type="submit" class="btn btn-md d-block w-100 text-white btn-primario">Guardar</button>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <a title="Regresar" href="{{ route('archivos.index') }}" class="text-end fs-6 text-secundario"><img src="{{ asset('img/regresa.jpg')}}" width="30" height="30"></a>
                </div>
            </form>
            <!-- Form End -->
        </div>
    </div>
    <!-- Form Container End -->
</div>
<!-- General container End -->
@endsection

@section('scripts')
<script>
    $('#btn-general-information').click((e) => {
        e.preventDefault();
        $('#general-information').toggle(500);
    });
</script>
@endsection
