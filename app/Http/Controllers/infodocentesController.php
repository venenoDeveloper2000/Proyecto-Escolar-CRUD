<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\infodocentes;
use App\Models\usuarios;

use Illuminate\Support\Facades\Auth;
class infodocentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function seccionPersonal()
    {
        return "Hola";
    }
    public function index(Request $request)
    {
        //

        //return usuarios::all();
        $items = infodocentes::select('infodocentes.activo as activo','infodocentes.idindo','infodocentes.edad','usuarios.nombre','usuarios.apellido_materno','usuarios.apellido_paterno','infodocentes.gradoAcad','infodocentes.ingles','tipo_de_usuarios.nombre as tipo')->join('usuarios','usuarios.idu','=','infodocentes.idu')->join('tipo_de_usuarios','tipo_de_usuarios.idtu','=','usuarios.idtu')->where('infodocentes.idindo', 'LIKE', "%$request->q%")->where('tipo_de_usuarios.nombre','=','Docentes')->paginate( ($request->paginate) ? $request->paginate : 10 );
        return view('infodocentes.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        /*$db = \DB::select("SELECT reportes.Carreras,
        reportes.promedio,
        reportes.Evaluadas
        FROM
        (SELECT
        carreras.nombre AS 'Carreras',
        carreras.idca AS 'id_carreras',
        SUM('1'),
        AVG(evaluaciones.calificacion) AS 'promedio',
        COUNT(evaluaciones.calificacion) AS 'Evaluadas'
        FROM evaluaciones
        RIGHT JOIN grupos ON grupos.idg=evaluaciones.idg
        RIGHT JOIN carreras ON carreras.idca=grupos.idca
        WHERE grupos.idce=2
        GROUP BY carreras.nombre,carreras.idca) AS reportes
        ;");
        return $db;*/
        $registroDeMaestros = usuarios::select('idu','nombre','apellido_paterno','apellido_materno')->where('idtu','2')->get();
        //return $registroDeMaestros;
        //return Auth::user()->idadmin;
        return view('infodocentes.create',compact('registroDeMaestros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // idtu = 2 donde es un docente
        /*
            Ejemplo de formato de datos
                * MAHJ280603MSPRRV09 -> CURP
*               * MAHJ280603MSP -> RFC
        */

        /*$validacionMatricula= usuarios::select('*')->where('matricula','=',$request->matricula)->where('idtu','=',2)->get();
        $statusMatricula = count($validacionMatricula);*/
        //return $request->all();

        $this->validate($request,[
            'curp'=>['required','regex:/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/'],
            'rfc'=>['required','regex:/^([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$/'],
            'edad'=>['required','regex:/^[1-9]{1}[0-9]{1}$/'],
            'telefono'=>['required','regex:/^[0-9]{10}$/'],
            'especialidad'=>['required'],
            'ingles'=>['required'],
            'gradoAcad'=>['required','regex:/^[A-Z,Á,É,Í,Ó,Ú]{1}[a-z,á,é,í,ó,ú, ]+$/'],
            'anioslab'=>['required','numeric'],
            'aniosdoc'=>['required','numeric'],
            'numCed'=>['required','regex:/^[0-9]{8}$/'],
            'calle'=>['required','regex:/^[0-9,A-Z,Á,É,Í,Ó,Ú]{1}[A-Z,a-z,á,é,í,ó,ú,0-9, ]+$/'],
            'colonia'=>['required','regex:/^[0-9,A-Z,Á,É,Í,Ó,Ú]{1}[A-Z,a-z,á,é,í,ó,ú,0-9, ]+$/'],
            'fechaIng'=>['required'],
            'cp'=>['required','numeric','min:5'],
            'cv_files'=>['mimes:pdf','max:500'],
            'actaN_files'=>['mimes:pdf','max:500'],
            'cedulaP_files_copy'=>['mimes:pdf','max:500'],
            'titulo_files_copy'=>['mimes:pdf','max:500'],
            'curp_files'=>['mimes:pdf','max:500'],
            'cItep_files'=>['mimes:pdf','max:500']

        ]);
        //$ext = ".pdf";
        if($request->hasFile('cv_files') || $request->hasFile('actaN_files') || $request->hasFile('cedulaP_files_copy') || $request->hasFile('titulo_files_copy')||$request->hasFile('curp_files')||$request->hasFile('cItep_files'))
        {
            $archivos = [
                'cv_files'=>$request->file("cv_files"),
                'actaN_files'=>$request->file("actaN_files"),
                'cedulaP_files_copy'=>$request->file("cedulaP_files_copy"),
                'titulo_files_copy'=>$request->file("titulo_files_copy"),
                'curp_files'=>$request->file("curp_files"),
                'cItep_files'=>$request->file("cItep_files")
            ];
            //return $archivos;
            $archivosNombre = [];
            foreach($archivos as $index=>$elemento)
            {
                //return  $elemento;
                if($elemento!=null)
                {
                    $archivosNombre[$index]=$elemento->getClientOriginalName();
                }
                else
                {
                    $archivosNombre[$index]=null;
                }
            }
            /*$archivosNombre = [
                $archivos[0]->getClientOriginalName(),
                $archivos[1]->getClientOriginalName(),
                $archivos[2]->getClientOriginalName(),
                $archivos[3]->getClientOriginalName(),
                $archivos[4]->getClientOriginalName(),
                $archivos[5]->getClientOriginalName(),
            ];*/
            $rutas = [];
            //return $archivosNombre;
            foreach($archivosNombre as $index => $ruta)
            {
                if($ruta!=null)
                {
                    //return $ruta;
                    $idDeDocumento = infodocentes::select('idindo')->orderBy('idindo','DESC')->get()[0]['idindo']+1;
                    //return $idDeDocumento;
                    $rutas[$index]=public_path("pdf/".$index.'__'.$idDeDocumento.'__'.$ruta);
                    //return $rutas;
                }
                else
                {
                    $rutas[$index]=null;
                }
            }

            //return $rutas;

            foreach($archivos as $file)
            {
                foreach($rutas as $nameFile)
                {
                    //return $rutas;
                    //return $archivos;
                    if($file!=null && $nameFile!=null)
                    {
                        copy($file,$nameFile);
                    }

                }
            }
            //$rutas = public_path("pdf/".$archivos);
            //return $rutas;
        }
        else
        {
            $archivos = [
                'cv_files'=>$request->file("cv_files"),
                'actaN_files'=>$request->file("actaN_files"),
                'cedulaP_files_copy'=>$request->file("cedulaP_files_copy"),
                'titulo_files_copy'=>$request->file("titulo_files_copy"),
                'curp_files'=>$request->file("curp_files"),
                'cItep_files'=>$request->file("cItep_files")
            ];
            $rutas=[];
            foreach($archivos as $index=>$path)
            {
                $rutas[$index]=null;
            }

        }
        //return $rutas;
        //$idu=$validacionMatricula[0]->idu;
        $infoDoc = new infodocentes;
        $infoDoc->idu = $request->idu;
        $infoDoc->edad = $request->edad;
        $infoDoc->curp = $request->curp;
        $infoDoc->rfc = $request->rfc;
        $infoDoc->telefono = $request->telefono;
        $infoDoc->especialidad = $request->especialidad;
        $infoDoc->ingles = $request->ingles;
        $infoDoc->gradoAcad = $request->gradoAcad;
        $infoDoc->anioslab = $request->anioslab;
        $infoDoc->aniosdoc = $request->aniosdoc;
        $infoDoc->fechaIng = $request->fechaIng;
        $infoDoc->numCed = $request->numCed;
        $infoDoc->calle = $request->calle;
        $infoDoc->colonia = $request->colonia;
        $infoDoc->cp = $request->cp;
        $infoDoc->id_uadm = Auth::user()->idadmin;
        $infoDoc->cv_files = $rutas['cv_files'];
        $infoDoc->actaN_files = $rutas['actaN_files'];
        $infoDoc->cedulaP_files_copy = $rutas['cedulaP_files_copy'];
        $infoDoc->titulo_files_copy = $rutas['titulo_files_copy'];
        $infoDoc->curp_files = $rutas['curp_files'];
        $infoDoc->cItep_files = $rutas['cItep_files'];
        $infoDoc->save();
        return redirect()->route('infodocentes.index')->with('message', "La información del docente ha sido capturada exitosamente");
        /*if($statusMatricula==0)
        {
            return redirect()->route('infodocentes.create')->withInput()->with('mat', "La matrícula no esta registrada, verifica de nuevo.");
        }*/
        /*else
        {
            $idMat=usuarios::select('usuarios.idu')->where('usuarios.matricula',$request->matricula)->get();
            $doubleTest = infodocentes::where('infodocentes.idu',$idMat[0]->idu)->get();
            if(count($doubleTest)!=0)
            {
                return redirect()->route('infodocentes.create')->withInput()->with('mat1', "Los datos de la matrícula ya fueron registrados.");
            }
            else
            {
                //return $doubleTest;
                $idu=$validacionMatricula[0]->idu;
                $infoDoc = new infodocentes;
                $infoDoc->idu = $idu;
                $infoDoc->edad = $request->edad;
                $infoDoc->curp = $request->curp;
                $infoDoc->rfc = $request->rfc;
                $infoDoc->telefono = $request->telefono;
                $infoDoc->especialidad = $request->especialidad;
                $infoDoc->ingles = $request->ingles;
                $infoDoc->gradoAcad = $request->gradoAcad;
                $infoDoc->anioslab = $request->anioslab;
                $infoDoc->aniosdoc = $request->aniosdoc;
                $infoDoc->fechaIng = $request->fechaIng;
                $infoDoc->numCed = $request->numCed;
                $infoDoc->calle = $request->calle;
                $infoDoc->colonia = $request->colonia;
                $infoDoc->cp = $request->cp;
                $infoDoc->id_uadm = Auth::user()->idadmin;
                $infoDoc->save();
                return redirect()->route('infodocentes.index')->with('message', "La información del docente ha sido capturada exitosamente");
            }

        }*/

        //return $request->status;
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
    public function edit(infodocentes $infoDoc)
    {
        //
        //return $infoDoc->idindo;
        $registroDeMaestros = usuarios::select('idu','nombre','apellido_paterno','apellido_materno')->where('idtu','2')->get();

        $items = infodocentes::select('*')->join('usuarios','usuarios.idu','=','infodocentes.idu')->where('infodocentes.idindo',$infoDoc->idindo)->get();
        //return $items;
        return view('infodocentes.edit',compact('items'))->with('registroDeMaestros',$registroDeMaestros);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, infodocentes $infoDoc)
    {
        //
        //return $request->all();
        /*$this->validate($request,[

            'curp'=>['required','regex:/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/'],
            'rfc'=>['required','regex:/^([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$/'],
            'edad'=>['required','regex:/^[1-9]{1}[0-9]{1}$/'],
            'telefono'=>['required','regex:/^[0-9]{10}$/'],
            'especialidad'=>['required'],
            'ingles'=>['required'],
            'gradoAcad'=>['required','regex:/^[A-Z,Á,É,Í,Ó,Ú]{1}[a-z,á,é,í,ó,ú, ]+$/'],
            'anioslab'=>['required','numeric'],
            'aniosdoc'=>['required','numeric'],
            'numCed'=>['required','regex:/^[0-9]{8}$/'],
            'calle'=>['required','regex:/^[0-9,A-Z,Á,É,Í,Ó,Ú]{1}[A-Z,a-z,á,é,í,ó,ú,0-9, ]+$/'],
            'colonia'=>['required','regex:/^[0-9,A-Z,Á,É,Í,Ó,Ú]{1}[A-Z,a-z,á,é,í,ó,ú,0-9, ]+$/'],
            'fechaIng'=>['required'],
            'cp'=>['required','numeric','min:5']

        ]);*/
        $this->validate($request,[
            'curp'=>['required','regex:/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/'],
            'rfc'=>['required','regex:/^([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$/'],
            'edad'=>['required','regex:/^[1-9]{1}[0-9]{1}$/'],
            'telefono'=>['required','regex:/^[0-9]{10}$/'],
            'especialidad'=>['required'],
            'ingles'=>['required'],
            'gradoAcad'=>['required','regex:/^[A-Z,Á,É,Í,Ó,Ú]{1}[a-z,á,é,í,ó,ú, ]+$/'],
            'anioslab'=>['required','numeric'],
            'aniosdoc'=>['required','numeric'],
            'numCed'=>['required','regex:/^[0-9]{8}$/'],
            'calle'=>['required','regex:/^[0-9,A-Z,Á,É,Í,Ó,Ú]{1}[A-Z,a-z,á,é,í,ó,ú,0-9, ]+$/'],
            'colonia'=>['required','regex:/^[0-9,A-Z,Á,É,Í,Ó,Ú]{1}[A-Z,a-z,á,é,í,ó,ú,0-9, ]+$/'],
            'fechaIng'=>['required'],
            'cp'=>['required','numeric','min:5'],
            'cv_files'=>['mimes:pdf','max:500'],
            'actaN_files'=>['mimes:pdf','max:500'],
            'cedulaP_files_copy'=>['mimes:pdf','max:500'],
            'titulo_files_copy'=>['mimes:pdf','max:500'],
            'curp_files'=>['mimes:pdf','max:500'],
            'cItep_files'=>['mimes:pdf','max:500']

        ]);
        $archivosAnteriores = infodocentes::select('cv_files','actaN_files','cedulaP_files_copy','titulo_files_copy','curp_files','cItep_files')->where('idindo',$infoDoc->idindo)->get();
        if($request->hasFile('cv_files') || $request->hasFile('actaN_files') || $request->hasFile('cedulaP_files_copy') || $request->hasFile('titulo_files_copy')||$request->hasFile('curp_files')||$request->hasFile('cItep_files'))
        {
            //return "HAY ENVIOS";
            $documentos = [
                'cv_files'=>$request->cv_files,
                'actaN_files'=>$request->actaN_files,
                'cedulaP_files_copy'=>$request->cedulaP_files_copy,
                'titulo_files_copy'=>$request->titulo_files_copy,
                'curp_files'=>$request->curp_files,
                'cItep_files'=>$request->cItep_files
            ];
            $rutas=[];
            foreach($documentos as $index=>$item)
            {
                //return $documentos;
                if($item)
                {
                    $nombre_documento = $item->getClientOriginalName();
                    $ruta_documento = public_path('pdf/'.$index.'__'.$infoDoc->idindo.'__'.$nombre_documento);
                    if($item!=null && $ruta_documento!=null)
                    {
                        copy($item,$ruta_documento);
                        $rutas[$index]='pdf/'.$index.'__'.$infoDoc->idindo.'__'.$nombre_documento;
                        //return $ruta_documento;
                    }
                    //return $ruta_documento;
                }
                else
                {
                    $rutas[$index]=$archivosAnteriores[0][$index];
                }
            }
            //return $rutas;
        }
        else
        {
            $documentos = $archivosAnteriores[0];
            $rutas = $documentos;
            //return $documentos;
        }
        //return $rutas;
        $infoDoc = infodocentes::find($infoDoc->idindo);
        $infoDoc->idu = $request->idu;
        $infoDoc->edad = $request->edad;
        $infoDoc->curp = $request->curp;
        $infoDoc->rfc = $request->rfc;
        $infoDoc->telefono = $request->telefono;
        $infoDoc->especialidad = $request->especialidad;
        $infoDoc->ingles = $request->ingles;
        $infoDoc->gradoAcad = $request->gradoAcad;
        $infoDoc->anioslab = $request->anioslab;
        $infoDoc->aniosdoc = $request->aniosdoc;
        $infoDoc->fechaIng = $request->fechaIng;
        $infoDoc->numCed = $request->numCed;
        $infoDoc->calle = $request->calle;
        $infoDoc->colonia = $request->colonia;
        $infoDoc->cp = $request->cp;
        $infoDoc->id_uadm = Auth::user()->idadmin;
        $infoDoc->cv_files = $rutas['cv_files'];
        $infoDoc->actaN_files = $rutas['actaN_files'];
        $infoDoc->cedulaP_files_copy = $rutas['cedulaP_files_copy'];
        $infoDoc->titulo_files_copy = $rutas['titulo_files_copy'];
        $infoDoc->curp_files = $rutas['curp_files'];
        $infoDoc->cItep_files = $rutas['cItep_files'];
        $infoDoc->save();
        return redirect()->route('infodocentes.index')->with('message', "La información del docente ha sido modificada de manera exitosa");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(infodocentes $item)
    {
        //
        $item->forceDelete();
        return redirect()->route('infodocentes.index')->with('message',"Registro eliminado exitosamente");
    }

    public function toggleStatus(Request $request, infodocentes $item)
    {
        $item->update($request->only('activo'));
        if($item->activo==1){
            return redirect()->route('infodocentes.index')->with('message', 'Registro activado exitosamente');
        }
        else{
            return redirect()->route('infodocentes.index')->with('message', 'Registro desactivado exitosamente');
        }
    }
}
