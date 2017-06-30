<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Problematica;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Problematica controller.
 *
 * @Route("admin/problematica")
 */
class ProblematicaController extends Controller
{
    /**
     * Lists all problematica entities.
     *
     * @Route("/", name="admin_problematica_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
//        $repo= $em->getRepository('AppBundle:Posteo')->findBy([], ['fecha' => 'DESC']);

        $problematicas = $em->getRepository('AppBundle:Problematica')->findBy([], ['fecha' => 'DESC']);

        return $this->render('problematica/index.html.twig', array(
            'problematicas' => $problematicas,
        ));
    }

    /**
     * Creates a new problematica entity.
     *
     * @Route("/new", name="admin_problematica_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $problematica = new Problematica();
        $form = $this->createForm('AppBundle\Form\ProblematicaType', $problematica);
        $form->get('pais')->setData("Argentina");
        $form->get('ciudad')->setData("Rio Cuarto");

        $form->get('provincia')->setData("Cordoba");
        $form->get('provincia')->setData("Cordoba");
        $form->get('fecha')->setData(new \DateTime('now'));


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($problematica);
            $em->flush();

            return $this->redirectToRoute('admin_problematica_show', array('id' => $problematica->getId()));
        }

        return $this->render('problematica/new.html.twig', array(
            'problematica' => $problematica,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a problematica entity.
     *
     * @Route("/{id}", name="admin_problematica_show")
     * @Method("GET")
     */
    public function showAction(Problematica $problematica)
    {
        $deleteForm = $this->createDeleteForm($problematica);

        return $this->render('problematica/show.html.twig', array(
            'problematica' => $problematica,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing problematica entity.
     *
     * @Route("/{id}/edit", name="admin_problematica_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Problematica $problematica)
    {
        $deleteForm = $this->createDeleteForm($problematica);
        $editForm = $this->createForm('AppBundle\Form\ProblematicaType', $problematica);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_problematica_index');
        }

        return $this->render('problematica/edit.html.twig', array(
            'problematica' => $problematica,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a problematica entity.
     *
     * @Route("/{id}", name="admin_problematica_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Problematica $problematica)
    {
        $form = $this->createDeleteForm($problematica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($problematica);
            $em->flush();
        }

        return $this->redirectToRoute('admin_problematica_index');
    }

    /**
     * Creates a form to delete a problematica entity.
     *
     * @param Problematica $problematica The problematica entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Problematica $problematica)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_problematica_delete', array('id' => $problematica->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    

}
