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
        $hoy = date('Y/m/d');

        $vencimiento='2017/08/16';
        if ( $vencimiento >= $hoy  ){
            
            return $this->redirectToRoute('actualizacion');

        }
        else{
            return $this->redirectToRoute('admin_problematica_index');

        }


    }





    /**
     * @Route("/actualizacion", name="actualizacion")
     */
    public function actualizacion(Request $request)
    {
        return $this->render('default/prueba.html.twig', array(
        ));

    }


//    /**
//     * @Route("/filtrado", name="filtrado")
//     */
//    public function filtrado(Request $request)
//    {
//        // replace this example code with whatever you need
//        $desde = $request->get('desde');
//        $hasta = $request->get('hasta');
//        $estado = $request->get('estado');
//        $problematica = $request->get('problematica');
//        $em = $this->getDoctrine()->getEntityManager();
//        $error="";
//        $problematicas="";
////        BUSQUEDA TOTAL
//        if (!empty($desde) and !empty($hasta) and !empty($estado) and !empty($problematica)) {
//            $query = $em->createQuery('SELECT u FROM AppBundle:Problematica u WHERE (u.fecha BETWEEN ?1 AND ?2) AND (u.estado = ?3) AND (u.tipoproblematica=?4)');
//            $query->setParameter(1, $desde);
//            $query->setParameter(2, $hasta);
//            $query->setParameter(3, $estado);
//            $query->setParameter(4, $problematica);
//            $problematicas = $query->getResult();
//
//
//        }
////        BUSQUEDA POR FECHA SOLA
//        elseif (!empty($desde) and !empty($hasta) and empty($estado) and empty($problematica)){
//            $query = $em->createQuery('SELECT u FROM AppBundle:Problematica u WHERE (u.fecha BETWEEN ?1 AND ?2)');
//            $query->setParameter(1, $desde);
//            $query->setParameter(2, $hasta);
//            $problematicas = $query->getResult();
//
//        }
////        BUSQUEDA POR FECHA Y ESTADO
//        elseif (!empty($desde) and !empty($hasta) and !empty($estado) and empty($problematica)){
//            $query = $em->createQuery('SELECT u FROM AppBundle:Problematica u WHERE (u.fecha BETWEEN ?1 AND ?2) AND (u.estado = ?3) ');
//            $query->setParameter(1, $desde);
//            $query->setParameter(2, $hasta);
//            $query->setParameter(3, $estado);
//            $problematicas = $query->getResult();
//
//        }
////        BUSQUEDA POR FECHA Y TIPO DE PROBLEMATICA
//        elseif (!empty($desde) and !empty($hasta) and empty($estado) and !empty($problematica)){
//            $query = $em->createQuery('SELECT u FROM AppBundle:Problematica u WHERE (u.fecha BETWEEN ?1 AND ?2) AND (u.tipoproblematica=?4) ');
//            $query->setParameter(1, $desde);
//            $query->setParameter(2, $hasta);
//            $query->setParameter(4, $problematica);
//            $problematicas = $query->getResult();
//
//        }
////        BUSQUEDA POR TIPO DE PROBLEMATICA Y ESTADO
//        elseif (empty($desde) and empty($hasta) and !empty($estado) and !empty($problematica)){
//            $query = $em->createQuery('SELECT u FROM AppBundle:Problematica u WHERE (u.estado=?3) AND (u.tipoproblematica=?4) ');
//            $query->setParameter(3, $problematica);
//
//            $query->setParameter(4, $problematica);
//            $problematicas = $query->getResult();
//
//        }
//
//        if (count($problematicas)==0){
//            $error="No hay problematicas de ese tipo";
//
//        }
//        elseif (count($problematicas)!=0){
//            $error="";
//        }
//        else{
//            $error="Error en la busqueda";
//
//        }
//
//
//        return $this->render('problematica/index.html.twig', array(
//            'problematicas' => $problematicas,
//            'error'=>$error,
//        ));


//
//    }



    /**
     * @Route("/inicio", name="inicio")
     */
    public function precentacionAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
//        $repo= $em->getRepository('AppBundle:Posteo')->findBy([], ['fecha' => 'DESC']);

        $users = $em->getRepository('AppBundle:User')->findAll();


        return $this->render('default/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * @Route("/Role", name="role")
     * @Method({"GET", "POST"})
     */
    public function changeRolnAction(Request $request)
    {
        $id = $request->request->get('id');


        $em = $this->getDoctrine()->getManager();
//        $repo= $em->getRepository('AppBundle:Posteo')->findBy([], ['fecha' => 'DESC']);

        $users = $em->getRepository('AppBundle:User')->find($id);
        $roles=$users->getRoles();
        $mns="";
        if ((in_array("ROLE_ADMIN", $roles )and !empty($roles))){
            $users->removeRole('ROLE_ADMIN');
            $mns="ROL REMOVIDO";

        }
        else{
            $users->addRole("ROLE_ADMIN");
            $mns="ROL AGREGADO";


        }
        $em->persist($users);
        $em->flush();
        return new JsonResponse($mns);


    }

    /**
     * @Route("/deleteaction", name="deleteaction")
     * @Method({"GET", "POST"})
     */

    public function deleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $username = $this->getUser()->getUsername();
        if ($username=="admin"){
            $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);

            $em->remove($user);
            $em->flush();
        }


        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('default/index.html.twig', array(
            'users' => $users,
        ));
    }




}
