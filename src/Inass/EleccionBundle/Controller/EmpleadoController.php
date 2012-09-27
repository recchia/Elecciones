<?php

namespace Inass\EleccionBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Inass\EleccionBundle\Entity\Empleado;

/**
 * Empleado controller.
 *
 * @Route("/empleado")
 */
class EmpleadoController extends Controller
{
    /**
     * Lists all Empleado entities.
     *
     * @Route("/", name="empleado")
     * @Template()
     */
    public function indexAction() 
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $query = $em->createQuery("SELECT e.id, e.cedula, e.nombres, e.apellidos, e.voto, p.nombre as estado FROM EleccionBundle:Empleado e JOIN e.estado p");
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($query, $this->get('request')->query->get('pagina', 1), 10);
        return compact('pagination');
    }

    /**
     * Finds and displays a Empleado entity.
     *
     * @Route("/{id}/show", name="empleado_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EleccionBundle:Empleado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empleado entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
    
    /**
     * Procesa el voto del empleado
     * 
     * @Route("/votar", name="empleado_voto")
     * @Method("POST")
     */
    public function votarAction(Request $request) 
    {
        if ($request->isXmlHttpRequest()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $entity = $em->getRepository('EleccionBundle:Empleado')->find($request->request->get('id'));
                $entity->setVoto(true);
                $em->persist($entity);
                $em->flush();
                return new \Symfony\Component\HttpFoundation\Response("El voto ha sido procesado");
            } catch (Exception $e) {
                return new \Symfony\Component\HttpFoundation\Response("El voto no ha sido procesado: " . $e->getMessage());
            }
        } else {
            return new \Symfony\Component\HttpFoundation\Response("Acceso Denegado");
        }
    }

}
