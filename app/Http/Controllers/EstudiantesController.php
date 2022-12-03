<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\estudiantes;
use App\Models\Carrera;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $items = estudiantes::select('estudiantes.ide','estudiantes.nombre','estudiantes.matricula', 'estudiantes.activo',
                                'carreras.nombre as carre')
                      ->join('carreras', 'carreras.idca', '=', 'estudiantes.idca')
                      ->where('estudiantes.ide', 'LIKE', "%$request->q%")
                      ->paginate( ($request->paginate) ? $request->paginate : 10 );



    //  $items = estudiantes::orderBy('nombre', 'asc')->where('nombre', 'LIKE', "%$request->q%")
    //               ->paginate( ($request->paginate) ? $request->paginate : 10 );
      return view('estudiantes.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $carreras = Carrera::all();
          return view('estudiantes.create')
          ->with('carreras',$carreras);
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

            'matricula'=>'required|regex:/^[0-9]{10}$/',
            'nombre'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú, ]+$/',
            'idca'=>'required',
            'sexo'=>'required',
            'activo'=>'required',

               ]);

               $estudiantes = new estudiantes;
               $estudiantes->nombre = $request->nombre;
               $estudiantes->matricula = $request->matricula;
               $estudiantes->idca = $request->idca;
               $estudiantes->sexo = $request->sexo;
               $estudiantes->activo = $request->activo;
               $estudiantes->save();
               //die("save exitoso");
               /*$libro = new libro;
               $libro->nombre = $request->nombre;
               $libro->idca= $request->idca;
               $libro->activo = $request->activo;
               $libro->save();*/

               return redirect()->route('estudiantes.index')->with('message', '
               Estudiante creado exitosamente');
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
    public function edit(estudiantes $estudiantes)
    {
        //
        //return $estudiantes;
        $consulta = estudiantes::select('estudiantes.sexo','estudiantes.ide','estudiantes.nombre',
                                'estudiantes.matricula', 'estudiantes.activo',
                                'carreras.nombre as carre','carreras.idca')
                      ->join('carreras', 'carreras.idca', '=', 'estudiantes.idca')
                      ->where('estudiantes.ide', '=', $estudiantes->ide)->get();
      $carreras = carrera::all();
   //return $consulta[0];
   return view('estudiantes.edit')->with('consulta',$consulta[0])->with('carreras',$carreras);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, estudiantes $estudiantes)
    {
        //
        $this->validate($request,[

            'matricula'=>'required|regex:/^[0-9]{10}$/',
            'nombre'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú, ]+$/',
            'idca'=>'required',
            'sexo'=>'required',
            'activo'=>'required',

               ]);
               $estudiantes= estudiantes::find($estudiantes->ide);
         $estudiantes->nombre= $request->nombre;
         $estudiantes->matricula= $request->matricula;
         $estudiantes->idca= $request->idca;
         $estudiantes->sexo= $request->sexo;
         $estudiantes->activo = $request->activo;
         $estudiantes->save();
         return redirect()->route('estudiantes.index')->with('message', '
               La informacion del estudiante ha sido modificada');
         return("UPDATES CHIDO");
        //return $estudiantes;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(estudiantes $item)
    {
      $item->forceDelete();
      return redirect()->route('estudiantes.index')->with('message',"Registro eliminado exitosamente");
    }

    public function toggleStatus(Request $request, estudiantes $item)
    {
        $item->update($request->only('activo'));
        if($item->activo==1){
            return redirect()->route('estudiantes.index')->with('message', 'Registro activado exitosamente');
        }
        else{
            return redirect()->route('estudiantes.index')->with('message', 'Registro desactivado exitosamente');
        }
    }
}
