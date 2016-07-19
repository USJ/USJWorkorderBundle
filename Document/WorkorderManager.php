<?php
namespace MDB\WorkorderBundle\Document;

use Doctrine\ODM\MongoDB\DocumentManager;
use MDB\WorkorderBundle\Model\WorkorderManager as BaseWorkorderManager;
use MDB\WorkorderBundle\Model\WorkorderInterface;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author Marco Leong
 */
class WorkorderManager extends BaseWorkorderManager
{
    protected $repository;
    protected $class;
    protected $dm;

    public function __construct(EventDispatcherInterface $dispatcher, $dm, $class)
    {
        parent::__construct($dispatcher);

        $this->dm = $dm;
        $this->class = $class;

        $this->repository = $this->dm->getRepository($class);
    }

    public function setDocumentManager(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    public function createWorkorder()
    {
        $class = $this->class;

        return new $class;
    }

    public function getDocumentManager()
    {
        return $this->dm;
    }

    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Get class name
     */
    public function getClass()
    {
        return $this->class;
    }

    protected function doSaveWorkorder($workOrder)
    {
        $this->dm->persist($workOrder);
        $this->dm->flush();
    }

    public function deleteWorkorder(WorkorderInterface $workorder)
    {
        $this->dm->remove($workorder);
        $this->dm->flush();
    }

    public function isNewWorkorder($workorder)
    {
        return !$this->dm->getUnitOfWork()->isInIdentityMap($workorder);
    }
}
