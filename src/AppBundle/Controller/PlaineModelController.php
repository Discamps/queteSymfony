<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PlaineModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Plainemodel controller.
 *
 * @Route("plainemodel")
 */
class PlaineModelController extends Controller
{
    /**
     * Lists all plaineModel entities.
     *
     * @Route("/", name="plainemodel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plaineModels = $em->getRepository('AppBundle:PlaineModel')->findAll();

        return $this->render('plainemodel/index.html.twig', array(
            'plaineModels' => $plaineModels,
        ));
    }

    /**
     * Creates a new plaineModel entity.
     *
     * @Route("/new", name="plainemodel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $plaineModel = new Plainemodel();
        $form = $this->createForm('AppBundle\Form\PlaineModelType', $plaineModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plaineModel);
            $em->flush();

            return $this->redirectToRoute('plainemodel_show', array('id' => $plaineModel->getId()));
        }

        return $this->render('plainemodel/new.html.twig', array(
            'plaineModel' => $plaineModel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a plaineModel entity.
     *
     * @Route("/{id}", name="plainemodel_show")
     * @Method("GET")
     */
    public function showAction(PlaineModel $plaineModel)
    {
        $deleteForm = $this->createDeleteForm($plaineModel);

        return $this->render('plainemodel/show.html.twig', array(
            'plaineModel' => $plaineModel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing plaineModel entity.
     *
     * @Route("/{id}/edit", name="plainemodel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PlaineModel $plaineModel)
    {
        $deleteForm = $this->createDeleteForm($plaineModel);
        $editForm = $this->createForm('AppBundle\Form\PlaineModelType', $plaineModel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plainemodel_edit', array('id' => $plaineModel->getId()));
        }

        return $this->render('plainemodel/edit.html.twig', array(
            'plaineModel' => $plaineModel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a plaineModel entity.
     *
     * @Route("/{id}", name="plainemodel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PlaineModel $plaineModel)
    {
        $form = $this->createDeleteForm($plaineModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plaineModel);
            $em->flush();
        }

        return $this->redirectToRoute('plainemodel_index');
    }

    /**
     * Creates a form to delete a plaineModel entity.
     *
     * @param PlaineModel $plaineModel The plaineModel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PlaineModel $plaineModel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('plainemodel_delete', array('id' => $plaineModel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
