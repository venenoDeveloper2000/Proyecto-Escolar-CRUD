<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\libro;
use App\Models\Carrera;
class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

  /*  $consulta = \DB::select("SELECT l.idl,l.nombre,c.nombre AS carre
FROM libros AS l
INNER JOIN carreras AS c ON c.idca = l.idca");*/

$consulta = libro::select('libros.nombre', 'libros.activo','carreras.nombre as carre')
                ->join('carreras', 'carreras.idca', '=', 'libros.idca')
                ->where('libros.nombre', 'LIKE', "%$request->q%")->paginate( ($request->paginate) ? $request->paginate : 10 );

      /*$consulta = libro::orderBy('nombre', 'asc')
      ->where('nombre', 'LIKE', "%$request->q%")->paginate( ($request->paginate) ? $request->paginate : 10 );*/
      return view('libro.index', compact('consulta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $carreras = Carrera::orderBy('nombre')->get();
      return view('libro.create')
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
      $this->validate($request,[

      'nombre'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,í,ó,á,ü,ñ,Ñ]+$/',
      'idca'=>'required',
      'activo'=>'required',

         ]);
         $libro = new libro;
         $libro->nombre = $request->nombre;
         $libro->idca= $request->idca;
         $libro->activo = $request->activo;
         $libro->save();

         return redirect()->route('libro.index')->with('message', 'Libro creado exitosamente');

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
