

    <!-- Input Text -->

    <!--<div class="form-floating my-2">
        <input
            @class(['form-control'=> !$errors->first('nombre'), 'form-control is-invalid' => $errors->first('nombre')])
            autocomplete="off"
            type="text"
            value="{{ old( 'nombre' ) }}"
            name="nombre" {{-- <-- Nombre del Campo --}}
            placeholder="input-text"
            id="input-text"
            >
        <label for="input-text">Número de cédula</label>

        @if($errors->first('nombre'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('nombre') }}</i>
        </div>
        @endif

    </div>-->
    <!-- Input Text End -->
    <div class="form-floating my-2 boton d-flex justify-content-between">
        <label class="boton btn btn-secondary px-3 col-12" for="input-text"><i class='bx bx-fw bxs-file-pdf  '></i> Suba el CURP<i class=' mx-2 bx bx-fw  bx-upload bx-burst bx-flip-horizontal' ></i></label>
        <input
            @class(['form-control boton__documento'=> !$errors->first('curp_files'), 'form-control is-invalid' => $errors->first('curp_files')])
            autocomplete="off"
            type="file"
            value="{{ old( 'curp_files' ) }}"
            name="curp_files" {{-- <-- Nombre del Campo --}}
            placeholder=""
            id="input-text"
            >


        @if($errors->first('curp_files'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('curp_files') }}</i>
        </div>
        @endif

    </div>


    <div class="form-floating my-2 boton d-flex justify-content-between">
        <label class="boton btn btn-secondary px-3 col-12" for="input-text"><i class='bx bx-fw bxs-file-pdf  '></i> Suba el documento ITEP<i class=' mx-2 bx bx-fw  bx-upload bx-burst bx-flip-horizontal' ></i></label>
        <input
            @class(['form-control boton__documento'=> !$errors->first('cItep_files'), 'form-control is-invalid' => $errors->first('cItep_files')])
            autocomplete="off"
            type="file"
            value="{{ old( 'cItep_files' ) }}"
            name="cItep_files" {{-- <-- Nombre del Campo --}}
            placeholder=""
            id="input-text"
            >


        @if($errors->first('cItep_files'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('cItep_files') }}</i>
        </div>
        @endif

    </div>

    <div class="form-floating my-2 boton d-flex justify-content-between">
        <label class="boton btn btn-secondary px-3 col-12" for="input-text"><i class='bx bx-fw bxs-file-pdf  '></i> Suba la copia del título<i class=' mx-2 bx bx-fw  bx-upload bx-burst bx-flip-horizontal' ></i></label>
        <input
            @class(['form-control boton__documento'=> !$errors->first('titulo_files_copy'), 'form-control is-invalid' => $errors->first('titulo_files_copy')])
            autocomplete="off"
            type="file"
            value="{{ old( 'titulo_files_copy' ) }}"
            name="titulo_files_copy" {{-- <-- Nombre del Campo --}}
            placeholder=""
            id="input-text"
            >


        @if($errors->first('titulo_files_copy'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('titulo_files_copy') }}</i>
        </div>
        @endif

    </div>

    <div class="form-floating my-2 boton d-flex justify-content-between">
        <label class="boton btn btn-secondary px-3 col-12" for="input-text"><i class='bx bx-fw bxs-file-pdf  '></i> Suba la cédula profesional<i class=' mx-2 bx bx-fw  bx-upload bx-burst bx-flip-horizontal' ></i></label>
        <input
            @class(['form-control boton__documento'=> !$errors->first('cedulaP_files_copy'), 'form-control is-invalid' => $errors->first('cedulaP_files_copy')])
            autocomplete="off"
            type="file"
            value="{{ old( 'cedulaP_files_copy' ) }}"
            name="cedulaP_files_copy" {{-- <-- Nombre del Campo --}}
            placeholder=""
            id="input-text"
            >


        @if($errors->first('cedulaP_files_copy'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('cedulaP_files_copy') }}</i>
        </div>
        @endif

    </div>

    <div class="form-floating my-2 boton d-flex justify-content-between">
        <label class="boton btn btn-secondary px-3 col-12" for="input-text"><i class='bx bx-fw bxs-file-pdf  '></i> Suba CV<i class=' mx-2 bx bx-fw  bx-upload bx-burst bx-flip-horizontal' ></i></label>
        <input
            @class(['form-control boton__documento'=> !$errors->first('cv_files'), 'form-control is-invalid' => $errors->first('cv_files')])
            autocomplete="off"
            type="file"
            value="{{ old( 'cv_files' ) }}"
            name="cv_files" {{-- <-- Nombre del Campo --}}
            placeholder=""
            id="input-text"
            >


        @if($errors->first('cedulaP_files_copy'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('cedulaP_files_copy') }}</i>
        </div>
        @endif

    </div>

    <div class="form-floating my-2 boton">
        <label class="boton btn btn-secondary px-3 col-12" for="input-text"><i class='bx bx-fw bxs-file-pdf  '></i> Suba el acta de nacimiento<i class=' mx-2 bx bx-fw  bx-upload bx-burst bx-flip-horizontal' ></i></label>
        <input
            @class(['form-control boton__documento'=> !$errors->first('actaN_files'), 'form-control is-invalid' => $errors->first('actaN_files')])
            autocomplete="off"
            type="file"
            value="{{ old( 'actaN_files' ) }}"
            name="actaN_files" {{-- <-- Nombre del Campo --}}
            placeholder=""
            id="input-text"
            >


        @if($errors->first('actaN_files'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('actaN_files') }}</i>
        </div>
        @endif

    </div>
    <!-- Input Select -->

    <!-- Input Select End -->

    <!-- Input Radios -->

    <!-- Input Radios End -->

    {{-- Input TextArea --}}

    {{-- Input TextArea End --}}


