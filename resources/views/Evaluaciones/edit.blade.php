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
                    <h1 class="text-white fw-bold text-uppercase text-center fs-4 mb-2">Modificar evaluación del profesor</h1>
                    <p class="text-white text-center fs-6 fw-light"></p>
                </div>
            </div>
            <!-- Container Slogan -->

            <!-- Form -->
            <form action="{{ route('Evaluaciones.update', $items) }}" class="form" method="POST">
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
                            <!-- Input Select -->
                            <div class="form-floating my-2">
                                <select name="idmat" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
                                    placeholder="Seleccione la materia">
                                    <!--<option >Seleccione la materia</option>-->
                                    @foreach($materias as $m)
                                    <option value={{$m->id_materias}} @if ($items->id_materias == $m->id_materias) selected @endif>{{$m->nombre}}</option>
                                    @endforeach
                                </select>
                                <label for="input-text">Seleccione la materia</label>

                                @if($errors->first('idmat'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('idmat') }}</i>
                                </div>
                                @endif
                            </div>
                            <!-- Input Select End -->
                            <!-- Input Select -->
                            <!-- <div class="form-floating my-2">
                                <select name="idc" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
                                    value="{{ old( 'idc' ) }}" placeholder="Seleccione el cuatrimestre" required>
                                    <option value="" selected disabled>Seleccione el cuatrimestre</option>
                                    @foreach($cuatrimestres as $c)
                                    <option value="{{$c->idc}}">{{$c->nombre}}</option>
                                    @endforeach
                                </select>
                                <label for="input-text">Seleccione el cuatrimestre</label>

                                @if($errors->first('idc'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('idc') }}</i>
                                </div>
                                @endif
                            </div>
                            -->
                            <!-- Input Select End -->
                            <!-- Input Select -->
                            <div class="form-floating my-2">
                                <select name="idg" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
                                    value="{{ old( 'idg' ) }}" placeholder="Seleccione el grupo" required>
                                    <option value="" selected disabled>Seleccione el grupo</option>
                                    @foreach($grupos as $g)
                                    <option value="{{$g->idg}}"@if ($items->id_grupo == $g->idg) selected @endif>{{$g->nombre}}</option>
                                    @endforeach
                                </select>
                                <label for="input-text">Seleccione el grupo</label>

                                @if($errors->first('idg'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('idg') }}</i>
                                </div>
                                @endif
                            </div>
                            <!-- Input Select End -->
                            <!-- Input Select -->
                            <div class="form-floating my-2">
                                <select name="idtu" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
                                    value="{{ old( 'idtu' ) }}" placeholder="Seleccione al profesor" required>
                                    <option value="" selected disabled>Seleccione al profesor</option>
                                    @foreach($materias as $m)
                                    <option value="{{$m->id_usuario}}"@if ($items->id_usuario== $m->id_usuario) selected @endif>{{$m->nombre_usuario.' '.$m->ap_paterno.' '.$m->ap_materno}}</option>
                                    @endforeach
                                </select>
                                <label for="input-text">Seleccione al profesor</label>

                                @if($errors->first('idtu'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('idtu') }}</i>
                                </div>
                                @endif
                            </div>
                            <!-- Input Select End -->
                            <!-- Input Select -->
                            <div class="form-floating my-2">
                                <select name="idc" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
                                    value="{{ old( 'idc' ) }}" placeholder="Seleccione el cuatrimestre" required>
                                    <option value="" selected >Seleccione el cuatrimestre</option>
                                    @foreach($cuatrimestres as $ce)
                                    <option value="{{$ce->idc}}"@if ($items->idcua == $ce->idc) selected @endif>{{$ce->nombre}}</option>
                                    @endforeach
                                </select>
                                <label for="input-text">Seleccione el cuatrimestre</label>

                                @if($errors->first('idc'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('idc') }}</i>
                                </div>
                                @endif
                            </div>
                            <!-- Input Select End -->
                            <!-- Input Text -->
                            <div class="form-floating my-2">
                                <input
                                    @class(['form-control'=> !$errors->first('calificacion'), 'form-control is-invalid' => $errors->first('calificacion')])
                                    autocomplete="off"
                                    type="text"
                                    value="{{ $items->calificacion }}"
                                    name="calificacion" {{-- <-- Nombre del Campo --}}
                                    placeholder="input-text"
                                    id="input-text"
                                    autofocus='true'>
                                <label for="input-text">Calificación del profesor</label>

                                @if($errors->first('calificacion'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('calificacion') }}</i>
                                </div>
                                @endif
                            </div>
                            {{-- Input TextArea --}}

                            {{-- Input TextArea End --}}
                        </div>
                    </div>
                </section>
                <!-- Personal Information Section End -->
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-3">
                        <button type="submit" class="btn btn-md d-block w-100 text-white btn-primario">Actualizar</button>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <a title="Regresar" href="{{ route('Evaluaciones.index') }}" class="text-end fs-6 text-secundario"><img src="{{ asset('img/regresa.jpg')}}" width="30" height="30"></a>
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
