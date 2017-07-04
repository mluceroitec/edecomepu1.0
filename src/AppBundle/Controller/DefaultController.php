<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->redirectToRoute('admin_problematica_index');

//        // replace this example code with whatever you need
//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
//        ]);
    }

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

}
