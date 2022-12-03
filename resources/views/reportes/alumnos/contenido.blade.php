<div class="row">
    <div class="col-12">
        <table class="table table-primaria d-none d-lg-table text-center align-center">
            <thead class="table-head fw-bold">
                <th>Carreras</th>
                <th>Grupos</th>
                <th>Docentes</th>
                <th>Opciones</th>
                <th>&nbsp;</th>
            </thead>
            <tbody id="">
                @foreach ($listas as $lista)
                <tr class="d-none d-lg-table-row col-12">
                    <td class="align-center col-5">{{ $lista->nombreCarreras }}</td>

                    <td class="align-center col-2">{{ $lista->numeroGrupos }}</td>

                    <td class="align-center col-3">{{ $lista->numeroDocentes }} </td>
                    <td class="align-center col-2">
                        {{--nombreCarreras en lugar de $lista->idca--}}
                        <a href="{{ route('detalle_carreras', ['id' => $lista->iddeLaC, 'idce' => $idce]) }}"
                            class="btn btn-primario text-white btn-sm d-block mx-auto w-75">Detalle</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
