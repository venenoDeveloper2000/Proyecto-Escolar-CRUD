@extends('layouts.app')
@section('title', 'Consulta Alumnos')

@section('content')
    <div class="container-fluid p-0">
        <!-- Container Slogan -->
        <div class="col-12 bg-primario rounded-top mb-3">
            <div class="col-12 py-4">
                <h1 class="text-white fw-bold text-uppercase text-center fs-4 mb-2">Consulta Evaluación Docente</h1>
                <h1 class="text-white fw-bold text-uppercase text-center fs-6 fw-light">

                        Ciclo Escolar: {{ $datos->ciclo }} &nbsp;&nbsp;
                        Carrera : {{ $datos->carrera }} &nbsp;&nbsp;

                </h1>

            </div>
        </div>
        <!-- Container Slogan -->

        <!-- Contenido -->
        <div class="row w-100 h-100 m-0 p-0">

            <!-- Header Section -->
            <div class="col-12 col-md-3 text-center my-2">
            </div>

            <div class="col-12 col-md-5 text-center my-2 d-flex">

            </div>

            <div class="col-12 col-md-4">
            </div>
            <!-- Header Section -->

            <div class="col-12">
                @include('layouts.partials.alerts')
            </div>

            <!-- desktop version -->
            <div class="row">
                <div class="col-12">
                    <table class="table table-primaria d-none d-lg-table text-center align-center">
                        <thead class="table-head fw-bold">
                            <th>&nbsp;</th>
                            <th>Grupos</th>
                            <th>Docentes</th>
                            <th>Pendiente</th>
                            <th>Completadas</th>
                            <th>Opciones</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody id="">
                            @forelse($listas as $lista)
                                <tr class="d-none d-lg-table-row col-12">
                                    <td> </td>
                                    <td class="col-5">{{ $lista->nombre_grupos }}</td>

                                    <td class="col-2">{{ $lista->cuantosm }}</td>
                                    <td class="col-1">
                                    <span style="background-color:#DB162F" class="badge badge-warning"><i class='bx bxs-bell-ring bx-tada' ></i> {{$lista->restan}}</span>
                                        {{--042A2B,32A287,0075A2,DB162F,225560,5D737E,CF995F,2374AB,2A9D8F,254D32--}}

                                    </td>
                                    <td class="col-1">
                                        <span style="background-color:#0075A2" class="badge badge-warning"><i class='bx bxs-bell-ring bx-tada' ></i> {{$lista->maeseval}}</span>
                                            {{--042A2B,32A287,0075A2,DB162F,225560,5D737E,CF995F,2374AB,2A9D8F,254D32--}}

                                        </td>
                                    <td class="align-center col-3">
                                        {{--propiedad en el route $lista->idg--}}
                                        <a href="{{ route('detalle_grupos', ['id' => $lista->idg]) }}"
                                            class="btn btn-primario text-white btn-sm d-block mx-auto w-50">Detalle</a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-9">
            </div>
            <div class="col-3">
                <a href="{{ route('regresar', ['idce' => $idce]) }}"
                    class="btn btn-primario text-white btn-sm d-block mx-auto w-50">Regresar</a>
            </div>
            <!-- desktop version End -->

            @forelse($listas as $lista)
                <!-- Mobile Version -->
                <div class="card shadow-lg my-3 py-3 mx-auto d-lg-none">
                    <div class="card-title text-center fw-bold">Grupo: {{ $lista->nombre_grupos }}</div>
                    <div class="card-body text-center">
                        <p> Docentes: {{ $lista->cuantosm }} </p>
                    </div>
                    <div class="card-body text-center">
                        <a href="{{ route('detalle_grupos', ['id' => 2]) }}"
                            class="btn btn-primario text-white btn-sm d-block mx-auto w-75">Detalle</a>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                        </div>
                    </div>
                </div>
                <!-- Mobile Version End -->
            @empty
            @endforelse

        </div>
        <!-- Contenido End -->

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(() => {
            $('#select-number-items').change(() => {
                $('#form-number-items').submit();
            });
        });
    </script>
@endsection
