@extends('layouts.app')

@section('title', 'Áreas')

@section('content')
<!-- custom js Programas acdemicos -->
@include('layouts.customProgramas.tabs')
@include('layouts.customProgramas.uiJquery')
<!-- end of scripts -->
<div class="alert-container">
    @if(session('mat'))
    <div class="alert alert-error m-0 text-center fw-bold fs-6 w-100 my-2">{{session("mat")}}</div>
    @endif
</div>
<div class="alert-container">
    @if(session('mat1'))
    <div class="alert alert-error m-0 text-center fw-bold fs-6 w-100 my-2">{{session("mat1")}}</div>
    @endif
</div>
<!-- General Container -->
<div class="container-fluid p-0">
    <!-- Form Container -->
    <div class="container-fluid">
        <div class="row justify-content-center">

            <!-- Container Slogan -->
            <div class="col-12 bg-primario rounded-top mb-3">
                <div class="col-12 py-4">
                    <h1 class="text-white fw-bold text-uppercase text-center fs-4 mb-2">Información docente</h1>
                    <p class="text-white text-center fs-6 fw-light"></p>
                </div>
            </div>
            <!-- Container Slogan -->

            <!-- Form -->
            <form action="{{ route('infodocentes.store') }}" class="form" method="POST" id="formularioDoc" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <!-- Tabs section -->
                <!-- Hide Section Button -->
                <div class="row justify-content-center">
                    <!-- seccion de tabulacion -->
                    <div class="col-12 col-lg-10 border-0" >
                        <ul id="boxTabsN" class="nav nav-tabs ">
                            <li class="nav-item navegacionTabs"><a class=" nav-link  text-primary " href="#tabs-1"><i class='bx-fw bx bxs-user-detail bx-burst-hover'></i> Datos personales</a></li>
                            <li class="nav-item navegacionTabs"><a class="nav-link" href="#tabs-2"><i class='bx-fw bx bxs-school bx-tada-hover'></i> Datos académicos</a></li>
                            <li class="nav-item navegacionTabs"><a class="nav-link" href="#tabs-3"><i class='bx-fw bxs-cloud-upload bx-fade-up-hover bx  bx-sm '></i> Captura de archivos</a></li>
                        </ul>



                    </div>
                    <!-- end section de tabulacion -->
                    {{-- <button id="btn-general-information" class="col-12 col-lg-10 border-0 text-white btn btn-primary mt-3 mb-1">
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
                    </button> --}}
                </div>
                <!-- Hide Section Button End -->

                <!-- Personal Information Section -->
                <br>
                <section id="general-information" class="col-12 col-lg-12" >
                    <div class="row justify-content-center" id="contents">






                        <!-- datos personales -->
                        <div class="col-12 col-lg-10 secciones " id="tabs-1">
                        @include('infodocentes.tabs Forms.tabs1')
                        </div>
                        <!-- end -->
                        <!-- datos academicos -->
                        <div class="col-12 col-lg-10 secciones" id="tabs-2">
                        @include('infodocentes.tabs Forms.tabs2')
                        </div>
                        <!-- end -->
                        <!-- subida de archivos -->
                        <div class="col-12 col-lg-10 secciones" id="tabs-3">
                        @include('infodocentes.tabs Forms.tabs3')
                        </div>
                        <!-- end -->
                    </div>
                </section>
                <!--<div class="row justify-content-center">
                    <div class="col-12 col-lg-3">
                        <button id="nextTab" class="btn btn-md d-block w-100 text-white btn-primario" type="button">Siguiente</button>
                    </div>
                </div>-->
                <!-- Personal Information Section End -->
                <div id="envioExi" class="row justify-content-center">
                    <div class="col-12 col-lg-3">
                        <button id="envioTab" type="submit" class="btn btn-md d-block w-100 text-white btn-primario">Guardar</button>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <a title="Regresar" href="{{ route('infodocentes.index') }}" class="text-end fs-6 text-secundario"><img src="{{ asset('img/regresa.jpg')}}" width="30" height="30"></a>
                </div>
                @include('infodocentes.jsForm.datosPersonales')
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
