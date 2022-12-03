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
                    <h1 class="text-white fw-bold text-uppercase text-center fs-4 mb-2">Editar informacion de la materia</h1>
                    <p class="text-white text-center fs-6 fw-light"></p>
                </div>
            </div>
            <!-- Container Slogan -->

            <!-- Form -->
            <!-- // POST ALTAS, PUT EDIT -->
            <form action="{{ route('materias.update',$items[0]) }}" class="form" method="POST">
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
                                <select name="idce" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
                                       value="{{ old( $items[0]->idce ) }}" placeholder="Seleccione carrera" required>
                                    <option value="" selected > Seleccione el ciclo escolar</option>
                                    @foreach($ciclos as $c)
                                    <option value="{{$c->idce}}" @if($c->idce==$items[0]->idce)selected @endif>{{$c->nombre}}</option>
                                    @endforeach
                                </select>
                                <label for="input-text">Seleccione el ciclo escolar</label>

                                @if($errors->first('idce'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('idce') }}</i>
                                </div>
                                @endif
                            </div>
                            <!-- Input Select End -->
                            <!-- Input Select -->
                            <div class="form-floating my-2">
                                <select name="idu" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
                                       value="{{  $items[0]->idu }}" placeholder="Seleccione carrera" required>
                                    <option value="" selected > Seleccione al docente</option>
                                    @foreach($docentes as $c)
                                    <option value="{{$c->idu}}" @if($c->idu==$items[0]->idu)selected @endif>{{$c->nombre.' '.$c->apellido_paterno.' '.$c->apellido_materno}}</option>
                                    @endforeach
                                </select>
                                <label for="input-text">Seleccione al docente</label>

                                @if($errors->first('idu'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('idu') }}</i>
                                </div>
                                @endif
                            </div>
                            <!-- Input Select End -->

                            <!-- Input Select -->
                            <div class="form-floating my-2">
                                <select name="idg" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
                                       value="{{ $items[0]->idg }}" placeholder="Seleccione carrera" required>
                                    <option value="" selected > Seleccione al grupo</option>
                                    @foreach($grupos as $c)
                                    <option value="{{$c->idg}}" @if($c->idg==$items[0]->idg)selected @endif>Grupo: {{$c->nombre}}</option>
                                    @endforeach
                                </select>
                                <label for="input-text">Seleccione al grupo</label>

                                @if($errors->first('idg'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('idg') }}</i>
                                </div>
                                @endif
                            </div>
                            <!-- Input Select End -->
                            <!-- Input Select -->
                            <div class="form-floating my-2">
                                <select name="idmat_carr" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
                                       value="{{ $items[0]->idmat_carr }}" placeholder="Seleccione carrera" required>
                                    <option value="" selected > Seleccione la materia</option>
                                    @foreach($materias as $c)
                                    <option value="{{$c->idmat_carr}}" @if($c->idmat_carr==$items[0]->idmat_carr)selected @endif>{{$c->nombre}}</option>
                                    @endforeach
                                </select>
                                <label for="input-text">Seleccione la materia</label>

                                @if($errors->first('idmat_carr'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('idmat_carr') }}</i>
                                </div>
                                @endif
                            </div>
                            <!-- Input Select End -->

                            <!-- Input Select -->
                            <div class="form-floating my-2">
                                <select name="idc" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
                                       value="{{ $items[0]->idc }}" placeholder="Seleccione carrera" required>
                                    <option value="" selected > Seleccione el cuatrimestre</option>
                                    @foreach($cuatrimestres as $c)
                                    <option value="{{$c->idc}}" @if($c->idc==$items[0]->idc)selected @endif>{{$c->nombre}}</option>
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
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-3">
                                    <button type="submit" class="btn btn-md d-block w-100 text-white btn-primario">Guardar</button>
                                </div>
                            </div>

                                </form>
                            </div>
                             {{-- end botón desactivar/activar --}}

                            <!-- Input Text End -->

                            <!-- Input Select -->






                                    <!-- Input Radio End -->

                                </div>
                            </div>
                            {{-- Input TextArea --}}

                            {{-- Input TextArea End --}}
                        </div>
                    </div>
                </section>
                <!-- Personal Information Section End -->

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
