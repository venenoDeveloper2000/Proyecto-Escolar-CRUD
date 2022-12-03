

    <!-- grado academico -->
    <div class="form-floating my-2">
        <input
            @class(['form-control'=> !$errors->first('gradoAcad'), 'form-control is-invalid' => $errors->first('gradoAcad')])
            autocomplete="off"
            type="text"
            value="{{ old( 'gradoAcad' ) }}"
            name="gradoAcad" {{-- <-- Nombre del Campo --}}
            placeholder="input-text"
            id="input-text"
            required>
        <label for="input-text">Grado académico máximo del docente</label>

        @if($errors->first('gradoAcad'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('gradoAcad') }}</i>
        </div>
        @endif

    </div>
    <!-- anioslab -->
    <div class="form-floating my-2">
        <input
            @class(['form-control'=> !$errors->first('anioslab'), 'form-control is-invalid' => $errors->first('anioslab')])
            autocomplete="off"
            type="text"
            value="{{ old( 'anioslab' ) }}"
            name="anioslab" {{-- <-- Nombre del Campo --}}
            placeholder="input-text"
            id="input-text"
            required>
        <label for="input-text">Años de experiencia laboral</label>

        @if($errors->first('anioslab'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('anioslab') }}</i>
        </div>
        @endif

    </div>
    <!-- aniosdoc -->
    <div class="form-floating my-2">
        <input
            @class(['form-control'=> !$errors->first('aniosdoc'), 'form-control is-invalid' => $errors->first('aniosdoc')])
            autocomplete="off"
            type="text"
            value="{{ old( 'aniosdoc' ) }}"
            name="aniosdoc" {{-- <-- Nombre del Campo --}}
            placeholder="input-text"
            id="input-text"
            required>
        <label for="input-text">Años de experiencia docente</label>

        @if($errors->first('aniosdoc'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('aniosdoc') }}</i>
        </div>
        @endif

    </div>
    <!-- numCed -->
    <div class="form-floating my-2">
        <input
            @class(['form-control'=> !$errors->first('numCed'), 'form-control is-invalid' => $errors->first('numCed')])
            autocomplete="off"
            type="text"
            value="{{ old( 'numCed' ) }}"
            name="numCed" {{-- <-- Nombre del Campo --}}
            placeholder="input-text"
            id="input-text"
            maxlength="8"
            required>
        <label for="input-text">Número de cédula profesional</label>

        @if($errors->first('numCed'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('numCed') }}</i>
        </div>
        @endif

    </div>


    <!-- fecha de ingreso -->
    <div class="form-floating my-2">
        <input
            @class(['form-control'=> !$errors->first('fechaIng'), 'form-control is-invalid' => $errors->first('fechaIng')])
            autocomplete="off"
            type="date"
            value="{{ old( 'fechaIng' ) }}"
            name="fechaIng" {{-- <-- Nombre del Campo --}}
            placeholder="input-text"
            id="input-text"
            required>
        <label for="input-text">Fecha de ingreso a la institución</label>

        @if($errors->first('fechaIng'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('fechaIng') }}</i>
        </div>
        @endif

    </div>
    <!-- Input Select -->
    <div class="form-floating my-2">
        <select name="ingles" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
               value="{{ old( 'ingles' ) }}" placeholder="Seleccione el nivel de inglés" required>
            <option value="" selected disabled> Seleccione su nivel de inglés</option>
            <option value="A1">A1</option>
            <option value="A2">A2</option>
            <option value="B1">B1</option>
            <option value="B2">B2</option>
            <option value="C1">C1</option>

            {{--@foreach($carreras as $c)--}}
            <!--<option value="{{--$c->idca--}}">{{--$c->nombre--}}</option>-->
            {{--@endforeach--}}
        </select>
        <label for="input-text">Seleccione el nivel de inglés</label>

        @if($errors->first('ingles'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('ingles') }}</i>
        </div>
        @endif
    </div>
    <!-- Input Select End -->
    <!-- especialidad -->
    <div class="form-check my-2">
        <div class="row items-center justify-content-center">
            <h3 class="text-start  fs-6">¿Se encuentra cursando alguna especialidad?</h3>
            <!-- Input Radio -->
            <div class="col-6 d-md-flex justify-content-center">
                <div>
                    <input class="form-check-input mx-auto" name="especialidad"{{-- <-- Nombre del Campo --}} type="radio" id="opcion-1" value="1" required checked>
                    <label class="form-check-label ms-1" for="opcion-1"> Si </label>
                </div>
            </div>
            <!-- Input Radio End -->

            <!-- Input Radio -->
            <div class="col-6 d-md-flex justify-content-center">
                <div>
                    <input class="form-check-input mx-auto" name="especialidad"{{-- <-- Nombre del Campo --}} type="radio" id="opcion-2" value="0" required>
                    <label class="form-check-label ms-1" for="opcion-2"> No </label>
                </div>
            </div>
            <!-- Input Radio End -->

        </div>
    </div>

    <!-- Input Text End -->



    <!-- Input Radios -->

    <!-- Input Radios End -->

    {{-- Input TextArea --}}

    {{-- Input TextArea End --}}

