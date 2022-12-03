<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class infoReporteController extends Controller
{
    //--------------------------start consulta-------------------------------------------------
    public function consulta()
    {
        //return "SOY LA CONSULTA";
        //Consulta de todos los ciclos escolares
        $ciclos = DB::select('SELECT * FROM ciclo_escolars ORDER BY nombre ASC');
        //return $ciclos;
        return view('reportes.informacionDocente.consulta')
            ->with(['ciclos' => $ciclos]);
    }
    //--------------------------end consulta-------------------------------------------------


    //--------------------------start contenido-------------------------------------------------
    public function contenido(Request $request)
    {
        //return "contenido de info";
        //Consulta todos los ciclos escolares
        $ciclos = DB::select('SELECT * FROM ciclo_escolars ORDER BY nombre ASC');
        // return $ciclos; idce => 1,2,3,4
        //idce del ciclo escolar seleccionado
        $idce = $request->get('idce');
        // return $idce;  idce actual del select
        //Consulta el nombre del ciclo escolar seleccionado
        $ce_select = DB::select("SELECT ce.nombre AS nombre
        FROM ciclo_escolars AS ce
        WHERE ce.idce = $idce");
        //return $ce_select;selecciona el idce de la vista (select) en una consulta
        //Lista los carreras, número de alumnos, número de grupos, del ciclo escolar sellccinado
        // $listas = DB::select("SELECT SUM(t1.alumno) as nalu,
        // t1.nombre as nombre,t1.idca as idca, SUM('1') AS ngru
        // FROM
        // (SELECT ac.idg, c.nombre, c.idca, SUM('1') AS alumno
        // FROM alumnos_carreras AS ac
        // INNER JOIN grupos AS g ON g.idg = ac.idg
        // INNER JOIN carreras AS c ON c.idca = g.idca
        // WHERE g.idce = $idce
        // GROUP BY ac.idg,c.nombre,c.idca) AS t1
        // GROUP BY t1.nombre,t1.idca
        // ");

        /*$listas = DB::select("SELECT SUM(t1.profesor) AS nalu,
        t1.nombre AS nombre,t1.idca AS idca, SUM('1') AS ngru
        FROM
        (SELECT ac.idg, c.nombre, c.idca, SUM('1') AS profesor
        FROM evaluaciones AS ac
        INNER JOIN grupos AS g ON g.idg = ac.idg
        INNER JOIN carreras AS c ON c.idca = g.idca
        WHERE g.idce = $idce
        GROUP BY ac.idg,c.nombre,c.idca) AS t1
        GROUP BY t1.nombre,t1.idca
        ");*/
        //return "hola";
        /*$listas = DB::select("SELECT
        reporte_evaluaciones.Carreras AS `nombreCarreras`,
        reporte_evaluaciones.numero_de_grupos AS `numeroGrupos`,
        reporte_evaluaciones.numero_de_docentes AS `numeroDocentes`,
        reporte_evaluaciones.idDeLaCarrera AS `iddeLaC`
        FROM
        (SELECT
        carreras.nombre AS `Carreras`,
        carreras.idca AS 'idDeLaCarrera',
        COUNT(DISTINCT materias.idg) AS `numero_de_grupos`,
        COUNT(DISTINCT materias.idu) AS `numero_de_docentes`
        FROM materias
        INNER JOIN usuarios ON usuarios.idu=materias.idu
        INNER JOIN cuatrimestres ON cuatrimestres.idc=materias.idc
        INNER JOIN grupos ON grupos.idg=materias.idg
        INNER JOIN carreras ON carreras.idca=grupos.idca
        INNER JOIN ciclo_escolars ON ciclo_escolars.idce=grupos.idce
        WHERE grupos.idce=$idce
        GROUP BY carreras.nombre,carreras.idca) AS reporte_evaluaciones;");*/
        $listas=DB::select("SELECT
        SUM('1') AS 'completados'
        -- COUNT(IF(idindo IS NULL, 1, 0)) AS 'Si'
         FROM
        (SELECT *
        FROM
        (SELECT infodocentes.idindo ,usuarios.idtu,usuarios.idu FROM  infodocentes LEFT OUTER JOIN usuarios ON usuarios.idu = infodocentes.idu
        UNION
        SELECT infodocentes.idindo ,usuarios.idtu,usuarios.idu  FROM infodocentes RIGHT OUTER JOIN usuarios ON usuarios.idu = infodocentes.idu

        ) AS documento
        WHERE idtu=2
        -- GROUP BY documento.docentes
        /*ORDER BY idindo,idu DESC*/
        ) AS DOC
        WHERE idindo IS NOT NULL;");
        $total = DB::select("SELECT COUNT(usuarios.idu) AS `numero_docentes` FROM usuarios WHERE usuarios.idtu=2;");
        //return $total;
        $falta=$total[0]->numero_docentes-$listas[0]->completados;

        //return $falta;
        $old[] =['completados'=>$listas[0]->completados] ;
        $old[]=['faltantes'=>$falta];
        return json_encode($old);
        //return json_encode($old);
        //$listas=[];
        //$listas['completados']=$old;
        //return $listas;
        //$listas['disponibles'] =
        //return $listas;
        /*$carrerasDoc = DB::select("SELECT idca,nombre FROM carreras");*/
        //return $carrerasDoc;

        //return $listas;
        return view("reportes.informacionDocente.contenido")
            ->with(['$ciclos' => $ciclos])
            ->with(['idce' => $idce])
            ->with(['$ce_select' => $ce_select])
            ->with(['listas' => $listas]);
            /*->with(['carrerasDoc' => $carrerasDoc]);*/
    }
    //---------------------------------end contenido----------------------------------------------


    //-------------------------start detalle carreras------------------------------------------
    public function detalle_carreras($id, $idce)
    {
        //idce del ciclo escolar seleccionado
        //return "SOY DETALLES CARRERAS";
        $idce = $idce;

        //idca de la carrera seleccionada
        $idca = DB::select("SELECT idca FROM carreras WHERE nombre LIKE '%$id%'
        ;");
        $idca = $idca[0]->idca;
        //return $idca;

        //Consulta el nombre del ciclo escolar y el nombre de la carrera seleccionada
        $datos = DB::select("SELECT distinct
        ca.nombre AS carrera, ce.nombre AS ciclo  FROM  grupos AS g
        inner join carreras AS ca ON ca.idca = g.idca
        inner join ciclo_escolars AS ce ON ce.idce = g.idce
        where g.idca = $idca && g.idce = $idce");

        //Lista los grupos, número de alumnos que tiene cada grupo
        /*$listas = DB::select("SELECT g.nombre AS nombre, g.idg AS idg, COUNT(*) as nalu
        FROM alumnos_carreras AS ac
        INNER JOIN grupos AS g ON g.idg = ac.idg
        WHERE g.idca = $idca AND g.idce = $idce
        GROUP BY g.nombre, g.idg");*/
        $listas = DB::select("SELECT g.idg,g.nombre AS nombre_grupos, COUNT(*) AS cuantosm,evalxgrupo(g.idg) AS maeseval,COUNT(*)-evalxgrupo(g.idg) AS restan
        FROM usuarios AS u
        INNER JOIN materias AS m  ON m.idu = u.idu
        INNER JOIN grupos AS g ON g.idg = m.idg
        WHERE u.idtu = 2 AND g.idca = $idca AND g.idce = $idce
        GROUP BY g.idg,g.nombre;");

        $statusCalif = DB::select("SELECT
        COUNT(super_reporte.grupos_super) AS `super_status`,
        super_reporte.grupos_super,
        super_reporte.super_calificacion
        FROM
        (SELECT
        status_reporte.nombre_grupos AS `grupos_super`,
        status_reporte.id_docente,
        status_reporte.materias_grupos,
        status_reporte.id_materias,
        status_reporte.id_docentes_materias,
        COUNT(status_reporte.Calificacion) AS `super_calificacion`
        FROM
        (SELECT
        grupos.nombre AS `nombre_grupos`,
        evaluaciones.calificacion AS `Calificacion`,
        evaluaciones.idtu AS `id_docente`,
        materias.nombre AS `materias_grupos`,
        materias.idmat AS `id_materias`,
        usuarios.idu AS `id_docentes_materias`
        FROM materias
        INNER JOIN grupos ON grupos.idg=materias.idg
        LEFT JOIN evaluaciones ON evaluaciones.idc=materias.idc
        INNER JOIN usuarios ON usuarios.idu=materias.idu
        WHERE grupos.idce=$idce AND grupos.idca=$idca) AS status_reporte
        GROUP BY status_reporte.nombre_grupos,status_reporte.id_docentes_materias) AS super_reporte
        GROUP BY super_reporte.grupos_super,super_reporte.super_calificacion;");
        //return $statusCalif;
        //return $listas;
        return view("reportes.informacionDocente.carrera")
            ->with(['idce' => $idce])
            ->with(['idca' => $idca])
            ->with(['datos' => $datos[0]])
            ->with(['listas' => $listas])
            ->with(['statusCalif'=>$statusCalif]);
    }
    //-------------------------end detalle carreras--------------------------------------------


    //-------------------------------start detalle_grupo---------------------------------------------
    public function detalle_grupos($id, Request $request)
    {
        return "H";
        //idg del grupo seleccionado
        //$idg = $id;
        $idg  = DB::select("SELECT idg FROM grupos WHERE grupos.nombre LIKE '%$id%';");
        $idg = $idg[0]->idg;
        //return $idg;
        //Consulta el nombre del ciclo escolar, nombre de la carrera y nombre del grupo seleccionados
        $datos = DB::select("SELECT distinct
        ce.nombre AS ciclo, ca.nombre AS carrera, g.nombre AS grupo,
        ce.idce AS idce, ca.idca AS idca
        FROM  grupos AS g
        inner join carreras AS ca ON ca.idca = g.idca
        inner join ciclo_escolars AS ce ON ce.idce = g.idce
        where g.idg = $idg
        ");

       //Consulta la información de los usuarios que pertenezcan al grupo
       /*$usuarios = DB::select("SELECT ac.idu, u.matricula AS matricula
       ,CONCAT(u.nombre,' ',u.apellido_paterno,' ',u.apellido_materno) AS nombreu, u.email AS email
       FROM alumnos_carreras AS ac
       INNER JOIN usuarios AS u ON u.idu = ac.idu
       WHERE ac.idg = $idg && u.nombre LIKE '%$request->q%'
       ");*/
       $usuarios=DB::select("SELECT
       CONCAT(usuarios.nombre,' ',usuarios.apellido_paterno,' ',usuarios.apellido_materno) AS `nombre_completo`,
       usuarios.matricula AS `docentes_matricula`,
       evaluaciones.calificacion AS `calificaciones_docente`
       FROM materias
       LEFT JOIN evaluaciones ON evaluaciones.idmat=materias.idmat
       INNER JOIN usuarios ON usuarios.idu=materias.idu
       WHERE materias.idg=$idg
       GROUP BY usuarios.nombre,usuarios.apellido_paterno,usuarios.apellido_materno,usuarios.matricula,evaluaciones.calificacion;");
        //return $usuarios;
        return view("reportes.informacionDocente.grupos")
            ->with(['idg' => $idg])
            ->with(['datos' => $datos[0]])
            ->with(['usuarios' => $usuarios]);
    }
    //--------------------------------end detalle_grupo-----------------------------------------------


    //-------------------------------start regresar---------------------------------------------
    public function regresar($idce)
    {
        return "Hola";
        //Consulta todos los ciclos escolares
        $ciclos = DB::select('SELECT * FROM ciclo_escolars ORDER BY nombre ASC');

        //idce del ciclo escolar seleccionado
        $idce = $idce;

        //Consulta el nombre del ciclo escolar seleccionado
        $ce_select = DB::select("SELECT ce.nombre AS nombre
        FROM ciclo_escolars AS ce
        WHERE ce.idce = $idce");

        //Lista los carreras, número de alumnos, número de grupos, del ciclo escolar sellccinado
        /*$listas = DB::select("SELECT SUM(t1.alumno) as nalu,
        t1.nombre as nombre,t1.idca as idca, SUM('1') AS ngru
        FROM
        (SELECT ac.idg, c.nombre, c.idca, SUM('1') AS alumno
        FROM alumnos_carreras AS ac
        INNER JOIN grupos AS g ON g.idg = ac.idg
        INNER JOIN carreras AS c ON c.idca = g.idca
        WHERE g.idce = $idce
        GROUP BY ac.idg,c.nombre,c.idca) AS t1
        GROUP BY t1.nombre,t1.idca
        ");*/
        $listas = DB::select("SELECT reportes.Carreras AS 'nameC',
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
        WHERE grupos.idce=$idce
        GROUP BY carreras.nombre,carreras.idca) AS reportes
        ;");

        return view("reportes.informacionDocente.consulta")
            ->with(['ciclos' => $ciclos])
            ->with(['idce' => $idce])
            ->with(['ce_select' => $ce_select])
            ->with(['listas' => $listas]);
    }
    //--------------------------------end regresar-----------------------------------------------
}
