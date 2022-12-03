<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\archivos;
use App\Models\usuarios;
use Illuminate\Support\Facades\Auth;
class archivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $items = archivos::select('archivos.idar','usuarios.matricula','usuarios.nombre as nombre','archivos.nombre as file','archivos.tipo as type','archivos.activo')->join('usuarios','usuarios.idu','=','archivos.idu')->where('archivos.idar', 'LIKE', "%$request->q%")->paginate( ($request->paginate) ? $request->paginate : 10 );
        return view('archivos.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('archivos.create');
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
            'nombre'=>['required','regex:/^[A-Z,a-z,á,é,í,ó,ú, ]+$/'],
            'ruta'=>['required','mimes:pdf','max:500']
        ]);
        $mat = \DB::select("select idu from usuarios where matricula = {$request->matricula}");
        //return $mat[0]->idu;
        if(count($mat)!=0)
        {
            if($request->hasFile('ruta'))
            {
                $archivo=$request->file("ruta");
                $ruta=$request->nombre."__".time().".".$archivo->guessExtension();
                $file=public_path("pdf/".$ruta);
                copy($archivo,$file);
                $record_files = new archivos;
                $record_files->nombre = $request->nombre;
                $record_files->ruta = $file;
                $record_files->tipo = $archivo->guessExtension();
                $record_files->idu = 15;
                $record_files->id_admin = Auth::user()->idadmin;
                $record_files->save();
                //return $request->file('ruta');
                return redirect()->route('archivos.index')->with('message', '
                Los archivos se han capturado exitosamente');
            }
        }
        else
        {
            return redirect()->route('archivos.create')->withInput()->with('error', '
            La matrícula no esta registrada.');
        }


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
    public function edit(archivos $archivos)
    {
        //
        $consulta = archivos::select('archivos.idar','archivos.idar','usuarios.matricula','usuarios.nombre as nombre','archivos.nombre as file','archivos.tipo as type','archivos.activo','archivos.nombre as name1','archivos.ruta','archivos.idu as idus')->join('usuarios','usuarios.idu','=','archivos.idu')->where('idar',$archivos->idar)->get();
        //return $consulta;
        return view('archivos.edit')->with('consulta',$consulta[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, archivos $archivos)
    {
        //

        if($request->hasFile('ruta'))
        {
            $archivo=$request->file("ruta");
            $ruta=$request->nombre."__".time().".".$archivo->guessExtension();
            $file=public_path("pdf/".$ruta);
            copy($archivo,$file);
            $record_files = $archivos::find($archivos->idar);
            $record_files->nombre = $request->nombre;
            $record_files->ruta = $file;
            $record_files->tipo = $archivo->guessExtension();
            $record_files->idu = $archivos->idu;
            $record_files->id_admin = Auth::user()->idadmin;
            $record_files->activo=  $archivos->activo;
            $record_files->save();
            //return $request->file('ruta');
            return redirect()->route('archivos.index')->with('message', '
            Los archivos se han capturado exitosamente');
        }

        else
        {
            $record_files = $archivos::find($archivos->idar);
            $record_files->nombre = $request->nombre;
            $record_files->idu = $archivos->idu;
            $record_files->id_admin = Auth::user();
            $record_files->activo=  $archivos->activo;
            $record_files->save();
            return redirect()->route('archivos.index')->with('message', '
            Los archivos se han capturado exitosamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archivos $item)
    {
        $item->forceDelete();
        return redirect()->route('archivos.index')->with('message',"Registro eliminado exitosamente");
    }

    public function toggleStatus(Request $request, Archivos $item)
    {
        $item->update($request->only('activo'));
        if($item->activo==1){
            return redirect()->route('archivos.index')->with('message', 'Registro activado exitosamente');
        }
        else{
            return redirect()->route('archivos.index')->with('message', 'Registro desactivado exitosamente');
        }
    }
}
