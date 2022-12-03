<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\materias_carreras;
use Illuminate\Support\Facades\DB;
class materiaCarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $items = materias_carreras::select('idmat_carr','nombre as nombrec','activo','clave','horas')
          ->where('materias_carreras.idmat_carr', 'LIKE', "%$request->q%")
          ->paginate( ($request->paginate) ? $request->paginate : 10 );
        return view('materiaCarrera.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $carreras = DB::select("SELECT *FROM carreras;");
        $cuatrimestres = DB::select("SELECT *FROM cuatrimestres;");
        return view('materiaCarrera.create')->with('carreras',$carreras)->with('cuatrimestres',$cuatrimestres);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'nombre'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,0-9, ]+$/',
            'horas'=>  'required|numeric'
        ]);
        $materiasCarreras = new materias_carreras();
        $materiasCarreras->nombre = $request->nombre;
        $materiasCarreras->idca = $request->idca;
        $materiasCarreras->idc=$request->idc;
        $materiasCarreras->clave=$request->clave;
        $materiasCarreras->horas = $request->horas;
        $materiasCarreras->activo=1;
        $materiasCarreras->save();
        //return $request->all();
        return redirect()->route('materiasCarreras.index')->with('message','La materia ha sido registrada de manera exitosa');
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
    public function edit(materias_carreras $mat_carr)
    {
        //
        $Carrera=DB::select("SELECT *FROM carreras");
        $Cuatrimestre = DB::select("SELECT *FROM cuatrimestres");
        $consulta = materias_carreras::select('*')->where($mat_carr->id)->get();
        /*return $consulta;
        return $mat_carr;*/
        return view('materiaCarrera.edit')->with('consulta',$consulta[0])->with('carreras',$Carrera)->with('cuatrimestres',$Cuatrimestre);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, materias_carreras $mat_carr)
    {
        //
        $this->validate($request,[
            'nombre'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,0-9, ]+$/',
            'horas'=>  'required|numeric'
        ]);
        $status=$mat_carr->activo;
        $mat_carr = materias_carreras::find($mat_carr->idmat_carr);
        $mat_carr->nombre=$request->nombre;
        $mat_carr->nombre = $request->nombre;
        $mat_carr->idca = $request->idca;
        $mat_carr->idc=$request->idc;
        $mat_carr->clave=$request->clave;
        $mat_carr->horas = $request->horas;
        $mat_carr->activo=$status;
        $mat_carr->save();

        return redirect()->route('materiasCarreras.index')->with('message', 'La informacion de la materia ha sido modificada');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(materias_carreras $item)
    {
        //
        $item->forceDelete();
        return redirect()->route('materiasCarreras.index')->with('message',"Registro eliminado exitosamente");
    }

    public function toggleStatus(Request $request, materias_carreras $items)
    {
        $items->update($request->only('activo'));
        if($items->activo==1){
            return redirect()->route('materiasCarreras.index')->with('message', 'Registro activado exitosamente');
        }
        else{
            return redirect()->route('materiasCarreras.index')->with('message', 'Registro desactivado exitosamente');
        }
    }
}
