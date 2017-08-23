<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 09/08/17
 * Time: 17:31
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class GraficosController extends Controller
{

    /**
     * @Route("/grafico", name="admin_problematica_graficos")
     */
    public function graficoAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render(':default:graficos.html.twig');
    }

    /**
     * @Route("/graficos", name="sql_result")
     * @Method({"GET", "POST"})
     */
    public function graficosAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $db = $em->getConnection();
        $query ="SELECT COUNT(tipoproblematica_id) AS cantidad,tipo_problematica.nombre FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id GROUP BY tipo_problematica.nombre ORDER BY COUNT(tipoproblematica_id) DESC";

        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);

        $result=$stmt->fetchAll();


        return new JsonResponse($result);


    }
    /**
     * @Route("/sql_fecha", name="sql_fecha")
     * @Method({"GET", "POST"})
     */
    public function fechaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $db = $em->getConnection();
        $hoy = date("Y-m-1");

        $datos=[];
        $nuevafecha='';
        for ($i = 1; $i <= 5; $i++) {

            if ($i==1){
                $nuevafecha = strtotime ( '-1 month' , strtotime ( $hoy) ) ;
                $nuevafecha = date ( 'Y-m-31' , $nuevafecha );

                $query ="SELECT COUNT(problematica.id) as cantidad FROM problematica WHERE problematica.fecha  BETWEEN '$nuevafecha' AND '$hoy' ";

            }
            elseif ($i==2){
                $nuevafecha = strtotime ( '-2 month' , strtotime ( $hoy) ) ;
                $nuevafecha = date ( 'Y-m-1' , $nuevafecha );
                $hasta = strtotime ( '-2 month' , strtotime ( $hoy) ) ;
                $hasta = date ( 'Y-m-31' , $hasta );
                $query ="SELECT COUNT(problematica.id) as cantidad FROM problematica WHERE problematica.fecha  BETWEEN '$nuevafecha' AND '$hasta' ";

            }
            elseif ($i==3){
                $nuevafecha = strtotime ( '-3 month' , strtotime ( $hoy) ) ;
                $nuevafecha = date ( 'Y-m-1' , $nuevafecha );
                $hasta = strtotime ( '-3 month' , strtotime ( $hoy) ) ;
                $hasta = date ( 'Y-m-31' , $hasta );

                $query ="SELECT COUNT(problematica.id) as cantidad FROM problematica WHERE problematica.fecha  BETWEEN '$nuevafecha' AND '$hasta' ";

            }
            elseif ($i==4){
                $nuevafecha = strtotime ( '-4 month' , strtotime ( $hoy) ) ;
                $nuevafecha = date ( 'Y-m-1' , $nuevafecha );
                $hasta = strtotime ( '-4 month' , strtotime ( $hoy) ) ;
                $hasta = date ( 'Y-m-31' , $hasta );
                $query ="SELECT COUNT(problematica.id) as cantidad FROM problematica WHERE problematica.fecha  BETWEEN '$nuevafecha' AND '$hasta' ";

            }
            else{
                $nuevafecha = strtotime ( '+1 month' , strtotime ( $hoy) ) ;
                $nuevafecha = date ( 'Y-m-31' , $nuevafecha );
                $query ="SELECT COUNT(problematica.id) as cantidad FROM problematica WHERE problematica.fecha  BETWEEN '$hoy' AND '$nuevafecha'";


            }

            $stmt = $db->prepare($query);
            $params = array();
            $stmt->execute($params);

            $result=$stmt->fetchAll();
            $datos[$i]=$result;


        }
        foreach ($datos as $dato){
            foreach ($dato as $dat){
                $resultado[]=$dat;


            }


        }





        return new JsonResponse($resultado);


    }
    /**
     * @Route("/sql_grafico", name="sql_grafico")
     * @Method({"GET", "POST"})
     */
    public function grafAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $db = $em->getConnection();
        $query ="SELECT COUNT(estado_id) AS cantidad,tipo_problematica.nombre FROM problematica INNER JOIN tipo_problematica ON problematica.tipoproblematica_id=tipo_problematica.id WHERE problematica.estado_id=2 GROUP BY tipo_problematica.nombre ORDER BY COUNT(tipoproblematica_id) DESC";

        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);

        $result=$stmt->fetchAll();

        $n = count($result);
        $array = array(
            "cantidad" => 0,
            "nombre" => null,
        );

        $d=["","","","","",""];
        for ($i = 0; $i <= 5; $i++) {
            if ($i<$n){
                $d[$i]=$result[$i];
            }
            else{
                $d[$i]=$array;
            }
        }

        return new JsonResponse($d);


    }


    /**
     * @Route("/sql_graficocalle", name="sql_graficocalle")
     * @Method({"GET", "POST"})
     */
    public function grafcalleAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $db = $em->getConnection();
        $query ="select problematica.calle, count(problematica.calle) as cantidad
from problematica WHERE problematica.estado_id=1
group by problematica.calle 
order by 2 desc LIMIT 6";

        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);

        $result=$stmt->fetchAll();

        $n = count($result);
        $array = array(
            "cantidad" => 0,
            "calle" => null,
        );

        $d=["","","","","",""];
        for ($i = 0; $i <= 5; $i++) {
            if ($i<$n){
                $d[$i]=$result[$i];
            }
            else{
                $d[$i]=$array;
            }
        }

        return new JsonResponse($d);


    }

}