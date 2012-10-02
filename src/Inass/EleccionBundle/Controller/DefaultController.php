<?php

namespace Inass\EleccionBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery("SELECT e.id, e.nombre FROM EleccionBundle:Estado e ORDER BY e.nombre");
        $estados = $query->execute(null, \Doctrine\ORM\Query::HYDRATE_ARRAY);
        $query = $em->createQuery("SELECT n.id, n.evento, n.accion, e.nombre as estado FROM EleccionBundle:Novedad n JOIN n.estado e ORDER BY n.id DESC");
        $query->setMaxResults(5);
        $novedades = $query->execute(null, \Doctrine\ORM\Query::HYDRATE_ARRAY);
        return array('estados' => $estados, 'novedades' => $novedades);
    }
    
    /**
     * @Route("/dataEmpleados", name="datos_grafico_empleados")
     */
    public function dataEmpleadosAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery("SELECT COUNT(e.id) FROM EleccionBundle:Empleado e");
        $total = $query->getSingleScalarResult();
        $query = $em->createQuery("SELECT COUNT(e.id) FROM EleccionBundle:Empleado e WHERE e.voto = TRUE");
        $votos = $query->getSingleScalarResult();
        $_data = array(array('Efectivos', (int)$votos), array('Pendientes', (int)($total-$votos)));
        $response = new Response(json_encode($_data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    /**
     * @Route("/dataAdultos", name="datos_grafico_adultos")
     */
    public function dataAdultosAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery("SELECT SUM(e.votantes) AS votantes, SUM(e.votos) AS votos FROM EleccionBundle:Estado e");
        $rs = $query->getSingleResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $_data = array(array('Efectivos', (int)$rs['votos']), array('Pendientes', (int)($rs['votantes']-$rs['votos'])));
        $response = new Response(json_encode($_data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    /**
     * @Route("/graficoxestado", name="grafico_estado")
     * @Template()
     */
    public function graficoxestadoAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery("SELECT e.id, e.nombre FROM EleccionBundle:Estado e ORDER BY e.nombre");
        $estados = $query->execute(null, \Doctrine\ORM\Query::HYDRATE_ARRAY);
        $query = $em->createQuery("SELECT e.id, e.nombre FROM EleccionBundle:Estado e WHERE e.id = :estado");
        $query->setParameter('estado', $request->request->get('estado'));
        $rs = $query->getSingleResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $query = $em->createQuery("SELECT n.id, n.evento, n.accion, e.nombre as estado FROM EleccionBundle:Novedad n JOIN n.estado e WHERE n.estado = :estado ORDER BY n.id DESC");
        $query->setParameter('estado', $request->request->get('estado'));
        $query->setMaxResults(5);
        $novedades = $query->execute(null, \Doctrine\ORM\Query::HYDRATE_ARRAY);
        return array('estado' => $request->request->get('estado'), 'titulo' => $rs['nombre'],'estados' => $estados, 'novedades' => $novedades);
    }
    
    /**
     * @Route("/dataEmpleadosxEstado", name="datos_grafico_empleados_x_estado")
     */
    public function dataEmpleadosxEstadoAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery("SELECT COUNT(e.id) FROM EleccionBundle:Empleado e WHERE e.estado = :estado");
        $query->setParameter('estado', $request->request->get('id'));
        $total = $query->getSingleScalarResult();
        $query = $em->createQuery("SELECT COUNT(e.id) FROM EleccionBundle:Empleado e WHERE e.voto = TRUE AND e.estado = :estado ");
        $query->setParameter('estado', $request->request->get('id'));
        $votos = $query->getSingleScalarResult();
        $_data = array(array('Efectivos', (int)$votos), array('Pendientes', (int)($total-$votos)));
        $response = new Response(json_encode($_data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    /**
     * @Route("/dataAdultosxEstado", name="datos_grafico_adultos_x_estado")
     */
    public function dataAdultosxEstadoAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery("SELECT SUM(e.votantes) AS votantes, SUM(e.votos) AS votos FROM EleccionBundle:Estado e WHERE e.id = :estado");
        $query->setParameter('estado', $request->request->get('id'));
        $rs = $query->getSingleResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $_data = array(array('Efectivos', (int)$rs['votos']), array('Pendientes', (int)($rs['votantes']-$rs['votos'])));
        $response = new Response(json_encode($_data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
