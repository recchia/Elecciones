<?php

namespace Inass\EleccionBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
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
        return array();
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
     * @Route("/testdata", name="datos_test")
     */
    public function testAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery("SELECT COUNT(e.id) FROM EleccionBundle:Empleado e");
        $total = $query->getSingleScalarResult();
        $query = $em->createQuery("SELECT COUNT(e.id) FROM EleccionBundle:Empleado e WHERE e.voto = TRUE");
        $votos = $query->getSingleScalarResult();
        //die("Resultado: ".$total." - ".$votos);
        $_data = array(array('Efectivos', (int)$votos), array('Pendientes', (int)($total-$votos)));
        $response = new Response(json_encode($_data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
