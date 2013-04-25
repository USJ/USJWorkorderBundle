<?php 
namespace MDB\WorkorderBundle\Document;
/**
* 
*/
class UserCommentManager
{
    protected $dm;
    protected $repository;
    protected $class;
    protected $dispatcher;

    public function __construct($dispatcher, $dm, $class)
    {
        $this->dispatcher = $dispatcher;
        $this->dm = $dm;
        $this->class = $class;
        $this->repository = $this->dm->getRepository($class);
    }

    public function createUserComment()
    {
        $class = $this->class;
        return new $class;
    }
}