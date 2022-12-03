
    <!-- Input Select -->
    <div class="form-floating my-2">
        <select name="idu" {{-- <-- Nombre del Campo --}} id="role_select" class="form-select form-control" autocomplete="off"
               value="{{ old( 'idu' ) }}" placeholder="Seleccione el nombre del profesor" required>
            <option value="" selected disabled> Seleccione al docente</option>

            <!--<option value="A1">A1</option>
            <option value="A2">A2</option>
            <option value="B1">B1</option>
            <option value="B2">B2</option>
            <option value="C1">C1</option>-->

            @foreach($registroDeMaestros as $name)
            <!--<option value="{{--$c->idca--}}">{{--$c->nombre--}}</option>-->
            <option value="{{$name->idu}}">{{$name->nombre}} {{$name->apellido_paterno}} {{$name->apellido_materno}}</option>
            @endforeach
        </select>
        <label for="input-text">Seleccione al profesor</label>

        @if($errors->first('idu'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('idu') }}</i>
        </div>
        @endif
    </div>

    <!-- CURP -->
    <div class="form-floating my-2">
        <input
            @class(['form-control'=> !$errors->first('curp'), 'form-control is-invalid' => $errors->first('curp')])
            autocomplete="off"
            type="text"
            value="{{ old( 'curp' ) }}"
            name="curp" {{-- <-- Nombre del Campo --}}
            placeholder="input-text"
            id="input-text"
            maxlength="18"
            required>
        <label for="input-text">CURP del docente</label>

        @if($errors->first('curp'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('curp') }}</i>
        </div>
        @endif

    </div>
    <!-- RFC -->
    <div class="form-floating my-2">
        <input
            @class(['form-control'=> !$errors->first('rfc'), 'form-control is-invalid' => $errors->first('rfc')])
            autocomplete="off"
            type="text"
            value="{{ old( 'rfc' ) }}"
            name="rfc" {{-- <-- Nombre del Campo --}}
            placeholder="input-text"
            id="input-text"
            maxlength="13"
            required>
        <label for="input-text">RFC del docente</label>

        @if($errors->first('rfc'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('rfc') }}</i>
        </div>
        @endif

    </div>
    <!-- Edad -->
    <div class="form-floating my-2">
        <input
            @class(['form-control'=> !$errors->first('edad'), 'form-control is-invalid' => $errors->first('edad')])
            autocomplete="off"
            type="text"
            value="{{ old( 'edad' ) }}"
            name="edad" {{-- <-- Nombre del Campo --}}
            placeholder="input-text"
            id="input-text"
            required>
        <label for="input-text">Edad del docente</label>

        @if($errors->first('edad'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('edad') }}</i>
        </div>
        @endif

    </div>
    <!-- telefono -->
    <div class="form-floating my-2">
        <input
            @class(['form-control'=> !$errors->first('telefono'), 'form-control is-invalid' => $errors->first('telefono')])
            autocomplete="off"
            type="text"
            value="{{ old( 'telefono' ) }}"
            name="telefono" {{-- <-- Nombre del Campo --}}
            placeholder="input-text"
            id="input-text"
            maxlength="10"
            required>
        <label for="input-text">Teléfono del docente</label>

        @if($errors->first('telefono'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('telefono') }}</i>
        </div>
        @endif

    </div>

    <!-- calle -->
    <div class="form-floating my-2">
        <input
            @class(['form-control'=> !$errors->first('calle'), 'form-control is-invalid' => $errors->first('calle')])
            autocomplete="off"
            type="text"
            value="{{ old( 'calle' ) }}"
            name="calle" {{-- <-- Nombre del Campo --}}
            placeholder="input-text"
            id="input-text"
            required>
        <label for="input-text">Nombre de la calle</label>

        @if($errors->first('calle'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('calle') }}</i>
        </div>
        @endif

    </div>
    <!-- colonia -->
    <div class="form-floating my-2">
        <input
            @class(['form-control'=> !$errors->first('colonia'), 'form-control is-invalid' => $errors->first('colonia')])
            autocomplete="off"
            type="text"
            value="{{ old( 'colonia' ) }}"
            name="colonia" {{-- <-- Nombre del Campo --}}
            placeholder="input-text"
            id="input-text"
            required>
        <label for="input-text">Nombre de la colonia</label>

        @if($errors->first('colonia'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('colonia') }}</i>
        </div>
        @endif

    </div>
    <!-- codigo postal cp -->
    <div class="form-floating my-2">
        <input
            @class(['form-control'=> !$errors->first('cp'), 'form-control is-invalid' => $errors->first('cp')])
            autocomplete="off"
            type="text"
            value="{{ old( 'cp' ) }}"
            name="cp" {{-- <-- Nombre del Campo --}}
            placeholder="input-text"
            id="input-text"
            maxlength="5"
            required>
        <label for="input-text">Código postal</label>

        @if($errors->first('cp'))
        <div class="invalid-feedback">
            <i>{{ $errors->first('cp') }}</i>
        </div>
        @endif
    </div>


