<?php

namespace Inass\EleccionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Inass\EleccionBundle\Entity\Novedad;
use Inass\EleccionBundle\Form\NovedadType;

/**
 * Novedad controller.
 *
 * @Route("/novedad")
 */
class NovedadController extends Controller
{
    /**
     * Lists all Novedad entities.
     *
     * @Route("/", name="novedad")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $query = $em->createQuery("SELECT n.id, n.evento, n.accion, e.nombre as estado FROM EleccionBundle:Novedad n JOIN n.estado e");
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($query, $this->get('request')->query->get('pagina', 1), 10);
        return compact('pagination');
    }

    /**
     * Finds and displays a Novedad entity.
     *
     * @Route("/{id}/show", name="novedad_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleccionBundle:Novedad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Novedad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Novedad entity.
     *
     * @Route("/new", name="novedad_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Novedad();
        $form   = $this->createForm(new NovedadType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Novedad entity.
     *
     * @Route("/create", name="novedad_create")
     * @Method("POST")
     * @Template("EleccionBundle:Novedad:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Novedad();
        $form = $this->createForm(new NovedadType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('novedad_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Novedad entity.
     *
     * @Route("/{id}/edit", name="novedad_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleccionBundle:Novedad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Novedad entity.');
        }

        $editForm = $this->createForm(new NovedadType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Novedad entity.
     *
     * @Route("/{id}/update", name="novedad_update")
     * @Method("POST")
     * @Template("EleccionBundle:Novedad:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleccionBundle:Novedad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Novedad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new NovedadType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('novedad_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Novedad entity.
     *
     * @Route("/{id}/delete", name="novedad_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EleccionBundle:Novedad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Novedad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('novedad'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
