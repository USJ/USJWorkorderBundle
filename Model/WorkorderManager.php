<?php
namespace MDB\WorkorderBundle\Model;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use MDB\WorkorderBundle\Event\WorkorderEvent;
use MDB\WorkorderBundle\Events;

/**
 * Abstract  of workorder manager
 */
abstract class WorkorderManager implements WorkorderManagerInterface
{
    protected $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function setEventDispatcher($dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function cloneWorkorder($workorder, $persist = false)
    {
        $newWo = clone $workorder;

        $newWo->setId(null);
        $newWo->setComments(new \Doctrine\Common\Collections\ArrayCollection());
        $newWo->setReferenceNumber(null);
        $newWo->setOrganizationCode(null);

        $oldStatus = $workorder->getStatus();
        if($oldStatus == 'CLOSE') {
            if(count($workorder->getAssignees())){
                $newWo->setStatus('ASSIGN');
            }else{
                $newWo->setStatus('REQUEST');
            }
        }

        if($workorder->getAsset()) {
            $newWo->setAsset($workorder->getAsset());
        }

        if($persist) {
            $this->saveWorkorder($newWo);
        }
        return $newWo;
    }

    public function saveWorkorder($workOrder)
    {
        $event = new WorkorderEvent($workOrder);
        $this->dispatcher->dispatch(Events::WORKORDER_PRE_PERSIST, $event);

        $this->doSaveWorkorder($workOrder);

        $event = new WorkorderEvent($workOrder);
        $this->dispatcher->dispatch(Events::WORKORDER_POST_PERSIST, $event);
    }

    public function findAllWorkorders()
    {
        return $this->repository->findAll();
    }

    public function findWorkorderBy($criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    public function findWorkorderById($id)
    {
        return $this->repository->findOneById($id);
    }

    public function findWorkordersBy($criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function getRepository()
    {
        return $this->repository;
    }
}
