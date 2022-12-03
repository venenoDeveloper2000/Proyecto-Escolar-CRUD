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
                    <h1 class="text-white fw-bold text-uppercase text-center fs-4 mb-2">Editar informacion de materia</h1>
                    <p class="text-white text-center fs-6 fw-light"></p>
                </div>
            </div>
            <!-- Container Slogan -->

            <!-- Form -->
            <!-- // POST ALTAS, PUT EDIT -->
            <form action="{{ route('materiasCarreras.update',$consulta) }}" class="form" method="POST">
                @csrf
                @method('PUT')
                {{--$consulta--}}
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
                                    @class(['form-control'=> !$errors->first('nombre'), 'form-control is-invalid' => $errors->first('nombre')])
                                    autocomplete="off"
                                    type="text"
                                    value="{{ $consulta->nombre }}"
                                    name="nombre" {{-- <-- Nombre del Campo --}}
                                    placeholder="input-text"
                                    id="input-text"
                                    required
                                    autofocus="true">
                                <label for="input-text">Nombre de de la materia</label>

                                @if($errors->first('nombre'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('nombre') }}</i>
                                </div>
                                @endif

                            </div>
                            <!-- Input Text End -->
                            <!-- Input Text -->
                            <div class="form-floating my-2">
                                <input
                                    @class(['form-control'=> !$errors->first('clave'), 'form-control is-invalid' => $errors->first('clave')])
                                    autocomplete="off"
                                    type="text"
                                    value="{{ $consulta->clave }}"
                                    name="clave" {{-- <-- Nombre del Campo --}}
                                    placeholder="input-text"
                                    id="input-text"
                                    required>
                                <label for="input-text">Clave de de la materia</label>

                                @if($errors->first('clave'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('clave') }}</i>
                                </div>
                                @endif

                            </div>
                            <!-- Input Text End -->
                            <!-- Input Text -->
                            <div class="form-floating my-2">
                                <input
                                    @class(['form-control'=> !$errors->first('horas'), 'form-control is-invalid' => $errors->first('horas')])
                                    autocomplete="off"
                                    type="text"
                                    value="{{ $consulta->horas}}"
                                    name="horas" {{-- <-- Nombre del Campo --}}
                                    placeholder="input-text"
                                    id="input-text"
                                    required>
                                <label for="input-text">Horas impartidas</label>

                                @if($errors->first('horas'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('horas') }}</i>
                                </div>
                                @endif

                            </div>
                            <!-- Input Text End -->

                            <!-- Input Select -->
                            <div class="form-floating my-2">
                                <select name="idca" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
                                       value="{{ $consulta->idca }}" placeholder="Seleccione carrera" required>
                                    <option value="" selected >-- Seleccione una carrera--</option>
                                    @foreach($carreras as $c)
                                    <option value="{{$c->idca}}" @if($c->idca==$consulta->idca) selected @endif>{{$c->nombre}}</option>
                                    @endforeach
                                </select>
                                <label for="input-text">Seleccione Carrera</label>

                                @if($errors->first('idca'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('idca') }}</i>
                                </div>
                                @endif
                            </div>
                            <!-- Input Select End -->
                            <!-- Input Select -->
                            <div class="form-floating my-2">
                                <select name="idc" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
                                       value="{{ $consulta->idc }}" placeholder="Seleccione carrera" required>
                                    <option value="" selected >-- Seleccione una cuatrimestre --</option>
                                    @foreach($cuatrimestres as $c)
                                    <option value="{{$c->idc}}" @if($c->idc==$consulta->idc) selected @endif>{{$c->nombre}} </option>
                                    @endforeach
                                </select>
                                <label for="input-text">Seleccione Cuatrimestre</label>

                                @if($errors->first('idc'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('idc') }}</i>
                                </div>
                                @endif
                            </div>
                            <!-- Input Select End -->









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
                    <a title="Regresar" href="{{ route('materiasCarreras.index') }}" class="text-end fs-6 text-secundario"><img src="{{ asset('img/regresa.jpg')}}" width="30" height="30"></a>
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
