<?php

namespace MDB\WorkorderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use MDB\WorkorderBundle\Status;

/**
 * Controller for work order
 */ 
class WorkorderController extends Controller
{

    /**
     * Retrieve all the work order
     * 
     * @Route("/workorders", name="mdb_workorder_workorder_index")
     * @Method({"GET"})
     */ 
    public function indexAction(Request $request)
    {
        $workOrderMgr = $this->container->get('mdb_workorder.manager.workorder');

        return $this->render("MDBWorkorderBundle:Workorder:index.html.twig", array(
                "workorders" => $workOrderMgr->findAllWorkorders()
            ));
    }

    /**
     * Show one work order
     * 
     * @Route("/workorders/new", name="mdb_workorder_workorder_new")
     * @Method({"GET", "POST"})
     */ 
    public function newAction(Request $request)
    {
        $manager = $this->container->get('mdb_workorder.manager.workorder');
        $workOrder = $manager->createWorkorder();
        $form = $this->container->get('mdb_workorder.form_factory.workrequest')->createForm();
        $workOrder->setStatus(Status::REQUEST);
        $form->setData($workOrder);

        if($request->getMethod() === 'POST') {

            $form->bind($request);
            if($form->isValid()) {
                $this->container->get('mdb_workorder.manager.workorder')->saveWorkorder($workOrder);
            }else{
                $request->getSession()->getFlashBag()->add('error', 'Work request creation failed');
            }
            return $this->redirect($this->generateUrl('mdb_workorder_workorder_index'));
        }

        return $this->render("MDBWorkorderBundle:Workorder:new_workrequest.html.twig", array(
                "form" => $form->createView()
            ));
    }

    /**
     * Show one work order
     * 
     * @Route("/workorders/{id}", name="mdb_workorder_workorder_show")
     * @Method({"GET"})
     */ 
    public function showAction(Request $request, $id)
    {
        $workorder = $this->get('mdb_workorder.manager.workorder')->findWorkorderById($id);
        if(!$workorder){
            throw $this->createNotFoundException(sprintf("Work order with reference %s not found", $id));
        }

        return $this->render("MDBWorkorderBundle:Workorder:show.html.twig", array(
                "workorder" => $workorder
            ));
    }
    
    private function getManager()
    {
        return $this->container->get('doctrine_mongodb.odm.default_document_manager');
    }

    /**
     * Automatically filter by organization
     */
    private function findBy($otherCriteria = array() )
    {
        $organization_code = $organization->getCode();
        $criteria = array_merge($otherCriteria, array('organization' => $organization_code));
        $workOrders = $this->container->get('mdb_workorder.manager.workorder')->findBy($criteria);
    }

    /**
     * Automatically filter by organization
     */
    private function findOneBy($otherCriteria = array() )
    {
        $organization_code = $this->getUser()->getOrganization()->getCode();
        $criteria = array_merge($otherCriteria, array('organization' => $organization_code));
        $workOrders = $this->container->get('mdb_workorder.manager.workorder')->findOneBy($criteria);
    }
}
