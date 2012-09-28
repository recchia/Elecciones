<?php

namespace Inass\EleccionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Inass\EleccionBundle\Entity\Seguimiento;
use Inass\EleccionBundle\Form\SeguimientoType;

/**
 * Seguimiento controller.
 *
 * @Route("/seguimiento")
 */
class SeguimientoController extends Controller
{
    /**
     * Lists all Seguimiento entities.
     *
     * @Route("/", name="seguimiento")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EleccionBundle:Seguimiento')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Seguimiento entity.
     *
     * @Route("/{id}/show", name="seguimiento_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleccionBundle:Seguimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seguimiento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Seguimiento entity.
     *
     * @Route("/new", name="seguimiento_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Seguimiento();
        $form   = $this->createForm(new SeguimientoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Seguimiento entity.
     *
     * @Route("/create", name="seguimiento_create")
     * @Method("POST")
     * @Template("EleccionBundle:Seguimiento:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Seguimiento();
        $form = $this->createForm(new SeguimientoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('seguimiento_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Seguimiento entity.
     *
     * @Route("/{id}/edit", name="seguimiento_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleccionBundle:Seguimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seguimiento entity.');
        }

        $editForm = $this->createForm(new SeguimientoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Seguimiento entity.
     *
     * @Route("/{id}/update", name="seguimiento_update")
     * @Method("POST")
     * @Template("EleccionBundle:Seguimiento:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleccionBundle:Seguimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seguimiento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SeguimientoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('seguimiento_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Seguimiento entity.
     *
     * @Route("/{id}/delete", name="seguimiento_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EleccionBundle:Seguimiento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Seguimiento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('seguimiento'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
