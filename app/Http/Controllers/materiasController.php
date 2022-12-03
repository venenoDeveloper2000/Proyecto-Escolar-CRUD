<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\materias;
use App\Models\cuatrimestres;
use App\Models\Carrera;
use App\Models\usuarios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class materiasController extends Controller
{
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index(Request $request)
      {
        //return materias::all();
          //$items = materias::select('*')
          //->join('cuatrimestres','cuatrimestres.idc','=','materias.idc')->join('carreras','carreras.idca','=','materias.idca')->where('nombre', 'LIKE', "%$request->q%")->paginate( ($request->paginate) ? $request->paginate : 10 );
          $items = materias::select('materias.idmat', 'cuatrimestres.nombre as name','materias_carreras.nombre as name1','materias.activo as activo1','usuarios.nombre AS docente','usuarios.apellido_paterno','usuarios.apellido_materno','grupos.nombre AS gruposN')
          ->join('cuatrimestres','cuatrimestres.idc','=','materias.idc')
          ->join('materias_carreras','materias_carreras.idmat_carr','=','materias.idmat_carr')
          ->join('usuarios','usuarios.idu','materias.idu')
          ->join('grupos','grupos.idg','materias.idg')
          ->where('materias.idmat', 'LIKE', "%$request->q%")
          ->paginate( ($request->paginate) ? $request->paginate : 10 );
          //return $items;
          return view('materias.index', compact('items'));


      }

      public function create()
      {

            $idtu=2;
            $materias = Carrera::all();
            $cuatrimestres = DB::select('select *from cuatrimestres order BY cuatrimestres.nombre ASC');
            $ciclos = DB::select('SELECT *FROM ciclo_escolars');
            $docentes = DB::select("SELECT *FROM usuarios WHERE idtu = $idtu");
            $grupos = DB::select('SELECT *FROM grupos ORDER BY grupos.nombre ASC');
            $materias = DB::select('SELECT *FROM materias_carreras ORDER BY materias_carreras.nombre ASC');
            // $cuatrimestres = cuatrimestres::all();
            /*
              ------------------------------------------------
              | $cuatrimestres -> modificado por una consulta
              | nativa (sin usar el modelo cuatrimestres)
              ------------------------------------------------
             */
            //return $cuatrimestres;
            return view('materias.create',compact('materias'))->with('item',$cuatrimestres)->with('ciclos',$ciclos)->with('docentes',$docentes)->with('grupos',$grupos)->with('materias',$materias);
            }

      public function store(Request $request)
      {
          //
          //return $request->all();
          //$idadmin= Auth::user()->idadmin;
        //return $request->all();
        $materias = new materias();
        $materias->idmat_carr = $request->idmat_carr;
        $materias->idu = $request->idu;
        $materias->idg = $request->idg;
        $materias->idce = $request->idce;
        $materias->idc = $request->idc;
        $materias->activo = 1;
        $materias->save();
        return redirect()->route('materias.index')->with('message',"El registro ha sido capturado de manera exitosa");
      }

      public function edit(materias $materias)
      {
          //
          //return $estudiantes;
        $idtu=2;
        $id= $materias->idmat;
        $consulta=materias::where('idmat',$id)->get();
        //return $consulta;
        $materias = Carrera::all();
        $cuatrimestres = DB::select('select *from cuatrimestres order BY cuatrimestres.nombre ASC');
        $ciclos = DB::select('SELECT *FROM ciclo_escolars');
        $docentes = DB::select("SELECT *FROM usuarios WHERE idtu = $idtu");
        $grupos = DB::select('SELECT *FROM grupos ORDER BY grupos.nombre ASC');
        $materias = DB::select('SELECT *FROM materias_carreras ORDER BY materias_carreras.nombre ASC');
        //return $consulta;
        return view('materias.edit')->with('items',$consulta)->with('cuatrimestres',$cuatrimestres)->with('ciclos',$ciclos)->with('docentes',$docentes)->with('grupos',$grupos)->with('materias',$materias);

     //return view('materias.edit')->with('consulta',$consulta[0])->with('materias',$materias);

      }

      public function update(Request $request, materias $materias)
      {
          //

        /*$this->validate($request,[

              'nombre'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú, ]+$/',
              'horas'=>  'required|regex:/^[0-9]{10}$/',
              'activo'=>'required',
            ]);*/
            //return "se actualizaron los datos";
                 $materia= materias::find($materias->idmat);
                 $materias = $materia;
                 $materias->idmat_carr = $request->idmat_carr;
                 $materias->idu = $request->idu;
                 $materias->idg = $request->idg;
                 $materias->idce = $request->idce;
                 $materias->idc = $request->idc;
                 $materias->activo = $materia->activo;
                 $materias->save();
                 //return $materia;
           return redirect()->route('materias.index')->with('message', '
                 La informacion de la materia ha sido modificada');


      }

      public function destroy(materias $item)
      {
        $item->forceDelete();
        return redirect()->route('materias.index')->with('message',"Registro eliminado exitosamente");
      }

      public function toggleStatus(Request $request, materias $item)
      {
          $item->update($request->only('activo'));
          if($item->activo==1){
              return redirect()->route('materias.index')->with('message', 'Registro activado exitosamente');
          }
          else{
              return redirect()->route('materias.index')->with('message', 'Registro desactivado exitosamente');
          }
      }
}
