<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 09/08/17
 * Time: 17:32
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class MapaController extends Controller

{
    /**
     * @Route("/map", name="admin_problematica_mapa")
     */
    public function testAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render(':default:mapa.html.twig');
    }
    /**
     * Displays a form to edit an existing Students entity.
     *
     * @Route("/carga", name="carga_mapaa")
     * @Method({"GET", "POST"})
     */
    public function cargamarcadores(Request $request)
    {
        $idproblematica = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();
        $db = $em->getConnection();
        $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id";

        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);
        $problematicas=$stmt->fetchAll();

        foreach ($problematicas as $problematica){
            $result[]=$problematica;


        }
        return new JsonResponse($result);


    }

    /**
     * Displays a form to edit an existing Students entity.
     *
     * @Route("/remplaza", name="remplaza_mapaa")
     * @Method({"GET", "POST"})
     */
    public function remplaza(Request $request)
    {
        $idproblematica = $request->request->get('option');

        $em = $this->getDoctrine()->getManager();
        $db = $em->getConnection();
        if ($idproblematica==7){
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id";

        }else{
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id WHERE  tipo_problematica.id='$idproblematica'";

        }

        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);
        $problematicas=$stmt->fetchAll();

        foreach ($problematicas as $problematica){
            $result[]=$problematica;


        }

        return new JsonResponse($result);


    }



    /**
     * @Route("/filt", name="filtradoo")
     */
    public function filtrado(Request $request)
    {
        // replace this example code with whatever you need

        $desde = $request->request->get('desde');
        $hasta = $request->request->get('hasta');
        $estado = $request->request->get('estado');
        $problematica = $request->request->get('problematica');
//        $desde = '2017-08-07';
//        $hasta = '2017-08-29';
//       $estado = 2;
//        $problematica = 3;
        $q= "problematica.tipoproblematica_id='$problematica'";
        $em = $this->getDoctrine()->getManager();
        $db = $em->getConnection();

//        BUSQUEDA TOTAl
        if (!empty($desde) and !empty($hasta) and !empty($estado) and !empty($problematica)) {
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id WHERE (problematica.fecha BETWEEN '$desde' AND '$hasta') AND problematica.tipoproblematica_id='$problematica' AND problematica.estado_id='$estado'";

        }
        //  BUSQUEDA POR RANGO DE FECHAS
        elseif (!empty($desde) and !empty($hasta) and empty($estado) and empty($problematica)){
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id WHERE (problematica.fecha BETWEEN '$desde' AND '$hasta')";

        }
        //  BUSQUEDA POR RANGO DE FECHAS Y PROBLEMATICA
        elseif (!empty($desde) and !empty($hasta) and empty($estado) and !empty($problematica)){
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id WHERE (problematica.fecha BETWEEN '$desde' AND '$hasta') AND problematica.tipoproblematica_id='$problematica' ";

        }
        //  BUSQUEDA POR RANGO DE FECHAS Y ESTADO
        elseif (!empty($desde) and !empty($hasta) and !empty($estado) and empty($problematica)){
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id WHERE (problematica.fecha BETWEEN '$desde' AND '$hasta') AND problematica.estado_id='$estado'";

        }
        //  BUSQUEDA FECHA Y ESTADO Y PROBLEMATICA
        elseif (!empty($desde) and empty($hasta) and !empty($estado) and !empty($problematica)){
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id WHERE problematica.fecha='$desde'  AND problematica.tipoproblematica_id='$problematica' AND problematica.estado_id='$estado'";

        }
        //  BUSQUEDA FECHA Y ESTADO
        elseif (!empty($desde) and empty($hasta) and !empty($estado) and empty($problematica)){
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id WHERE problematica.fecha='$desde'   AND problematica.estado_id='$estado'";

        }
        //  BUSQUEDA FECHA Y PROBLEMATICA
        elseif (!empty($desde) and empty($hasta) and empty($estado) and !empty($problematica)){
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id WHERE problematica.fecha='$desde'  AND problematica.tipoproblematica_id='$problematica' ";

        }
        //  BUSQUEDA FECHA
        elseif (!empty($desde) and empty($hasta) and empty($estado) and empty($problematica)){
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id WHERE problematica.fecha='$desde'   ";

        }
        //  BUSQUEDA PROBLEMATICA
        elseif (empty($desde) and empty($hasta) and empty($estado) and !empty($problematica)){
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id WHERE  problematica.tipoproblematica_id='$problematica' ";

        }
        //  BUSQUEDA ESTADO
        elseif (empty($desde) and empty($hasta) and !empty($estado) and empty($problematica)){
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id WHERE problematica.estado_id='$estado'";

        }
        //  BUSQUEDA ESTADO y PROBLEMATICA
        elseif (empty($desde) and empty($hasta) and !empty($estado) and !empty($problematica)){
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id WHERE  problematica.tipoproblematica_id='$problematica' AND problematica.estado_id='$estado'";

        }
        else{
            $query ="SELECT problematica.id,problematica.ciudad,problematica.latitud,problematica.longitud,problematica.descripcion,tipo_problematica.nombre,tipo_problematica.marcador FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id";

        }

        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);
        $problematicas=$stmt->fetchAll();

        foreach ($problematicas as $problematica){
            $result[]=$problematica;


        }

        return new JsonResponse($problematicas);



    }
}
