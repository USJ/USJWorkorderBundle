<?php
namespace MDB\WorkorderBundle\Document;

/**
*
*/
class StatusManager
{
    protected $class;
    protected $dm;
    protected $repository;
    protected $dispatcher;

    public function __construct($dispatcher, $dm, $class)
    {
        $this->dispatcher = $dispatcher;
        $this->class = $class;
        $this->dm = $dm;
        $this->repository = $this->dm->getRepository($class);
    }

    public function findAllStatuses()
    {
        return $this->repository->findAll();
    }

    public function findStatusByName($name)
    {
        return $this->repository->findOneByName($name);
    }
}
