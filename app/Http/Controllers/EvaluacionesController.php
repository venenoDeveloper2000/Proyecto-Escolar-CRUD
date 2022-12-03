<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluaciones;
use App\Models\materias;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
class EvaluacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = Evaluaciones::select('evaluaciones.idev','evaluaciones.idu as id_usuario','evaluaciones.idmat as id_materia','evaluaciones.idg as id_grupo', 'evaluaciones.calificacion', 'usuarios.nombre as nombre_us', 'usuarios.apellido_paterno as ap_paterno', 'usuarios.apellido_materno as ap_materno', 'materias_carreras.nombre as nombre_ma', 'grupos.nombre as nombre_gr', 'evaluaciones.activo as activo')
        ->join('usuarios','usuarios.idu','evaluaciones.idtu')
        ->join('materias','materias.idmat','evaluaciones.idmat')
        ->join('materias_carreras','materias_carreras.idmat_carr','materias.idmat_carr')
        ->join('grupos','grupos.idg','evaluaciones.idg')
                        ->where('evaluaciones.idev', 'LIKE', "%$request->q%")
                        ->paginate( ($request->paginate) ? $request->paginate : 10 );
    //------------------------------------------------------------------------------------------------------------------------
    //  $items = estudiantes::orderBy('nombre', 'asc')->where('nombre', 'LIKE', "%$request->q%")
    //               ->paginate( ($request->paginate) ? $request->paginate : 10 );
    //return $items;
    //------------------------------------------------------------------------------------------------------------------------
        return view('Evaluaciones.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $id)
    {

        $Materias=DB::select('SELECT * FROM materias INNER JOIN materias_carreras ON materias.idmat_carr=materias_carreras.idmat_carr');
        //return $Materias;
        $Cuatrimestres=DB::select('select * from cuatrimestres');
        //return $Cuatrimestres;
        $Grupos=DB::select('select * from grupos');
        //return $Grupos;
        $Profesores=DB::select('select * from usuarios where idtu = 2');
        //return $Profesores;
        $CicloEscolar=DB::select('select * from ciclo_escolars');
        //return $CicloEscolar;
        $Calificacion=DB::select('select * from evaluaciones');
        //return $Calificación;
        //return $Materias;
        return view('Evaluaciones.create')->with('materias', $Materias)->with('cuatrimestres', $Cuatrimestres)->with('grupos',$Grupos)->with('profesores' ,$Profesores)->with('ciclo_escolar',$CicloEscolar)->with('calificacion', $Calificacion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'calificacion'=>'numeric',
            'idmat'=>'required',
            'idg'=>'required',
            'idtu'=>'required',
            'idc'=>'required',
        ]);
        //return $request->all();
        if ($request->calificacion=='0'){
            $evaluaciones = new Evaluaciones;
            $evaluaciones->idu = Auth::user()->idadmin;
            $evaluaciones->idmat = $request->idmat;
            $evaluaciones->idg= $request->idg;
            $evaluaciones->idtu= $request->idtu;
            $evaluaciones->idc= $request->idc;
            $evaluaciones->calificacion= $request->calificacion;
            $evaluaciones->activo= 0;
            $evaluaciones->save();
        }
        else{
            $evaluaciones = new Evaluaciones;
            $evaluaciones->idu = Auth::user()->idadmin;
            $evaluaciones->calificacion = $request->calificacion;
            $evaluaciones->idmat = $request->idmat;
            $evaluaciones->idg= $request->idg;
            $evaluaciones->idtu= $request->idtu;
            $evaluaciones->idc= $request->idc;
            $evaluaciones->activo= 1;
            $evaluaciones->save();
        }
            return redirect()->route('Evaluaciones.index')->with('message', 'Registro modificado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluaciones $eva)
    {
        $items= Evaluaciones::select('evaluaciones.idev','evaluaciones.idu as id_usuario','evaluaciones.idmat as id_materia','evaluaciones.idg as id_grupo', 'evaluaciones.calificacion', 'usuarios.nombre as nombre_us', 'usuarios.apellido_paterno as ap_paterno', 'usuarios.apellido_materno as ap_materno', 'materias_carreras.nombre as nombre_ma','grupos.nombre as nombre_gr', 'evaluaciones.activo as activo','materias.idu as id_usuario','evaluaciones.idc as idcua')
        ->join('materias', 'materias.idmat', '=', 'evaluaciones.idmat')
        ->join('materias_carreras','materias_carreras.idmat_carr','materias.idmat_carr')
        ->join('administradores_plataforma', 'administradores_plataforma.idadmin', '=', 'evaluaciones.idu')
        ->join('usuarios', 'usuarios.idu', 'materias.idu')
        ->join('grupos', 'grupos.idg', '=', 'evaluaciones.idg')
        ->where('evaluaciones.idev', $eva->idev)->get();
        //return $items;

        $Materias=materias::select('materias.idu as id_usuario', 'materias.idmat as id_materias', 'materias_carreras.nombre as nombre', 'usuarios.nombre as nombre_usuario', 'usuarios.apellido_paterno as ap_paterno', 'usuarios.apellido_materno as ap_materno')
        ->join('usuarios', 'usuarios.idu', '=', 'materias.idu')
        ->join('materias_carreras','materias_carreras.idmat_carr','materias.idmat_carr')
        ->get();
        //return $Materias;
        $Cuatrimestres=DB::select('select * from cuatrimestres');
        //return $Cuatrimestres;
        $Grupos=DB::select('select * from grupos');
        //return $Grupos;
        $Profesores=DB::select('select * from usuarios where idtu = 2');
        //return $Profesores;
        $CicloEscolar=DB::select('select * from ciclo_escolars');
        //return $items;

        return view('Evaluaciones.edit')->with('items',$items[0])->with('materias', $Materias)->with('cuatrimestres', $Cuatrimestres)->with('grupos',$Grupos)->with('profesores' ,$Profesores)->with('ciclo_escolar',$CicloEscolar);
        //return $items;
        //$Calificacion=DB::select('select * from evaluaciones');
        //return $Calificación;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Evaluaciones $evaluaciones)
    {
        /*$this->validate($request,[
            'calificacion'=>'numeric',
            'idmat'=>'required',
            'idg'=>'required',
            'idtu'=>'required',
            'idce'=>'required',
        ]);*/
        //return $request->all();
        if ($request->calificacion=='0'){
            $evaluaciones = $evaluaciones;
            $evaluaciones->idu = Auth::user()->idadmin;
            $evaluaciones->idmat = $request->idmat;
            $evaluaciones->idg= $request->idg;
            $evaluaciones->idc= $request->idc;
            $evaluaciones->calificacion= $request->calificacion;
            $evaluaciones->activo= 0;
            $evaluaciones->save();
        }
        else{
            $evaluaciones = $evaluaciones;
            $evaluaciones->idu = Auth::user()->idadmin;
            $evaluaciones->calificacion = $request->calificacion;
            $evaluaciones->idmat = $request->idmat;
            $evaluaciones->idg= $request->idg;
            $evaluaciones->idc= $request->idc;
            $evaluaciones->activo= 1;
            $evaluaciones->save();
        }
            return redirect()->route('Evaluaciones.index')->with('message', 'Registro modificado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluaciones $items)
    {
        $items->forceDelete();
        return redirect()->route('Evaluaciones.index')->with('message',"Registro eliminado exitosamente");
    }

    public function toggleStatus(Request $request, Evaluaciones $items)
    {
        $items->update($request->only('activo'));
        if($items->activo==1){
            return redirect()->route('Evaluaciones.index')->with('message', 'Registro activado exitosamente');
        }
        else{
            return redirect()->route('Evaluaciones.index')->with('message', 'Registro desactivado exitosamente');
        }
    }
}
